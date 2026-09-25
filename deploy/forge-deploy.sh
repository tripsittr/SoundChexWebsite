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

# The database is one SQLite file, and it is gitignored — so it is absent on a
# fresh server and present, with every tracker item in it, on every deploy
# after that. Create it only when it is genuinely missing: a blind `touch` is
# harmless, but being explicit is what stops someone "tidying" this into
# something that truncates.
if [ ! -f database/database.sqlite ]; then
    echo "No database found — creating one for this fresh server."
    touch database/database.sqlite
fi

# --force because this is non-interactive. Migrations are additive; the 390
# tracker items live in the file above and are not touched by them.
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
