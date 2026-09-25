# Deploying the landing site

`forge-deploy.sh` is what Laravel Forge runs on each deploy. It lives here so
the deployed behaviour is reviewable in the repo rather than only in a web
form — paste it into **Site → Deployment → Deploy Script** after provisioning.

## Forge settings

| Setting | Value |
|---|---|
| Repository | `tripsittr/SoundChexWebsite` |
| Branch | `main` |
| Web directory | `/public` |
| PHP version | **8.4** — matches local; 8.5 is newer than anything here has run on |
| Build command | `npm run build` |
| Connect to database | **off** |
| Push to deploy | on |

## Why no database connection

The site uses SQLite: one file, currently 725 KB, holding the tracker. Forge
offers to provision MySQL and wire credentials into the env — harmless, but it
would run a database server nothing connects to.

`DB_DATABASE` is deliberately left unset, so it resolves through
`database_path('database.sqlite')` and is correct on any machine.

## The file is gitignored, and that is the point

`database/database.sqlite` is not in the repo, so a deploy cannot overwrite
it. On a fresh server it is therefore absent, which is why the script creates
it when it is missing and leaves it alone otherwise.

## Back it up

The tracker is ~390 items that exist nowhere else. On a single server that is
a single point of failure: enable the provider's snapshots, and consider
copying the file somewhere off the box on a schedule.

## First deploy

1. Provision, add the site, paste the script.
2. Set the env: `APP_URL=https://soundchex.app`, `APP_ENV=production`,
   `APP_DEBUG=false`, `DB_CONNECTION=sqlite`.
3. `php artisan key:generate` if the env has no `APP_KEY`.
4. Point an A record at the server, then issue the certificate.

`.app` is HSTS-preloaded at the TLD, so **every browser refuses plain HTTP** —
no redirect, no warning page. Issue the certificate before visiting the domain
or it will look broken for reasons unrelated to the app.
