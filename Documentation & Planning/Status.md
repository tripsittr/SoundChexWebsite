# Status — SoundChex Website

*Last updated: 2026-09-17.*

## What exists

- **The site**, served by Herd at `https://soundchex.test`, all pages tested
  (17 tests / 193 assertions green): landing page, `/download`, 23-page docs
  hub (`/docs`), 17-document legal suite (`/legal`) with committed PDFs.
- **SCNet waitlist** — the one dynamic piece: Livewire form → `waitlist_signups`
  (SQLite). Zero other data collection anywhere, and the legal suite commits
  to that publicly.
- **Brand** — tokens from the app repo with the accent corrected to the
  wordmark's real red (#d95145); Figtree self-hosted; dark-first.
- **Workflow scaffolding** — AGENTS.md, this folder, `changelog/` with entries
  001–007 covering every commit to date.

## What does not exist

- No GitHub remote (W-12), no production deployment or domain (W-11).
- No GitHub release, so every "Download" button dead-ends at a 404
  `releases/latest` (W-13).
- No activated donation platform — the Sponsor button 404s (W-08).
- No hero screenshots (W-09), no SVG wordmark / OG card (W-10).
- SCNet: nothing but the waitlist and the name (W-15).
- Legal: drafted, specific, and **unreviewed by counsel** (W-14).

## What is next

In order of unblocking value:

1. **W-12** GitHub remote — makes the PDFs' "in the repository" claim true and
   enables the PR workflow.
2. **W-11** Domain + hosting — the site is finished enough to be public.
3. **W-13** First release with installers — makes /download real (pairs with
   app-repo release work).
4. **W-08** Donations — one decision, ten minutes of setup.

## Known broken / honest caveats

- `github.com/sponsors/tripsittr` and `releases/latest` links 404 today
  (W-08, W-13) — both are "activate the external thing", not code.
- The app repo's accent token still differs from the site/logo (W-16).
- Herd resurrects a stale `SoundChex` Sites symlink from its internal DB if
  it resyncs; the fix that worked is manual `rm` + `ln -s` + `herd restart`
  (see the app repo's stale-path lore).
