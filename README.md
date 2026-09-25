# SoundChex Website

The landing site for [SoundChex](https://github.com/tripsittr/SoundChex) —
[soundchex.app](https://soundchex.app) — and the home of the **admin Tracker**,
which is the issue tracker for every SoundChex repository.

## The Tracker

Features, fixes and bugs for the server, the desktop app, iOS and this site all
live in one place: the admin panel at `/admin` → Tracker (a board) or Items (a
table). This is deliberate — one queue across every platform beats four files
that drift apart.

It is driven from the command line as well as the panel, and the other repos'
docs tell contributors to come here to do it:

```bash
php artisan track:issue "Title" --platform=ios --type=bug --priority=high
php artisan track:move 123 --to=in-progress
php artisan track:export        # a JSON snapshot, for backup
```

Snapshots are also written automatically before every deploy migrates, and an
Export button in the Board header downloads one. The tracker exists nowhere
else, so it is worth keeping a copy.

## The rest of the site

- `/` — the landing page, and `/download` for installers.
- `/roadmap` — the public roadmap, generated from the tracker items marked for
  publication.
- `/changelog` — what shipped, per release.
- `/docs` and `/docs/{slug}` — the documentation hub.
- `/legal` and `/legal/{slug}` — per-platform privacy policies and terms
  (Android, iOS, iPadOS, Linux, macOS, Windows, the server and this site), plus
  a cookie policy. These are Blade views, rendered per platform rather than
  maintained as separate documents.
- **SCNet** — the paid relay tier, currently a waitlist. Signups land in the
  admin panel.

## Getting started

Requires PHP 8.3+, Composer and Node 22+.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build        # or `npm run dev` while working on the site
php artisan serve
```

The database is SQLite and holds the tracker, so it is gitignored — a fresh
clone starts with an empty one. There is no import command yet: a snapshot from
`track:export` is a JSON array of rows with stable keys, so restoring one is a
short tinker script for now.

To reach the admin panel, make yourself a user:

```bash
php artisan make:filament-user
```

## Conventions

[AGENTS.md](AGENTS.md) is the source of truth: tracker item before the work,
`changelog/NNN-name.md` per change, `vendor/bin/pint --dirty` after PHP edits,
and `php artisan test` before a PR. No AI artifacts in commits or anything
published.

## Deploying

The site runs on Laravel Forge. `deploy/forge-deploy.sh` is the deploy script:
it installs, builds assets, writes a tracker snapshot, migrates, then rebuilds
the caches. The SQLite file lives in shared storage so deploys never touch it.

## License

This project (the SoundChex website) is **dual-licensed** like the rest of
SoundChex — **AGPL-3.0-or-later** by default (see [LICENSE](LICENSE)), or a
**commercial licence** for those who can't/won't comply with the AGPL. Full
terms, the contributor agreement, and the commercial option are in the main
repo: [LICENSING.md](https://github.com/tripsittr/SoundChex/blob/main/LICENSING.md)
(contact `licensing@soundchex.app`). Because the site is served over a network,
any modified, hosted build must offer those users its corresponding source
(AGPL §13).

The Laravel framework it is built on remains separately [MIT-licensed](https://opensource.org/licenses/MIT).
