# SoundChex landing site — Forge deploy script (W-228).
#
# Paste into Forge → Site → Deployment → Deploy Script. Kept in the repo so the
# deployed behaviour is reviewable rather than living only in a web form.

cd $FORGE_SITE_PATH

git pull origin $FORGE_SITE_BRANCH

$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# The assets are not committed, so without this the site deploys with no CSS
# and no JS — which reads as a broken site rather than a missing build step.
npm ci
npm run build

# A restore point from the moment before this deploy changed anything, which
# is exactly when you want one (W-32). Written to storage/, which survives a
# zero-downtime deploy — anything inside a release directory is discarded by
# the next one. Failure here must not stop the deploy: a missing snapshot is
# worse than no deploy only if it also blocks the fix.
$FORGE_PHP artisan track:export || echo "Snapshot failed — continuing."

# --force because this is non-interactive. Migrations are additive; the
# tracker items live in the SQLite file named by DB_DATABASE, which is an
# absolute path into storage/ and so is untouched by deploys.
$FORGE_PHP artisan migrate --force

# Caches rebuilt from the freshly pulled code. Cleared first: a cached config
# from the previous release survives the pull and is what makes an env change
# appear to do nothing.
$FORGE_PHP artisan config:clear
$FORGE_PHP artisan config:cache
$FORGE_PHP artisan route:cache
$FORGE_PHP artisan view:cache

# Filament compiles its own assets; after an upgrade the published ones are
# stale in a way that shows as missing icons rather than an error.
$FORGE_PHP artisan filament:optimize

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock
