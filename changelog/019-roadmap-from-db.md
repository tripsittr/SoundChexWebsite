# 019 — Roadmap reads from the DB; issues imported (W-30)

*2026-09-18.*

## Done

- **`/roadmap` now renders from the `items` table** — published items grouped by
  platform, DB status mapped to the tree's Available / In-progress / Planned
  states. Group metadata (heading, icon, blurb) stays in the view; content is
  data. A fallback to the original curated array keeps the page non-empty if
  nothing is published.
- **`php artisan items:import`** — parses every repo's Markdown tracker (app,
  iOS, Android, TV, Roku, website; two formats) into `items`, keyed on `ref` so
  it is idempotent and preserves panel edits (`published`, `public_summary`).
  Imported **248** items; section headings map to status (Open→planned,
  In progress, Deferred, Done).
- **`RoadmapSeeder`** — reproduces the 19 published roadmap items from git, so a
  fresh environment shows the roadmap without the sibling repos present.

## Worth knowing

The importer reads the sibling repos (…/SoundChex App, …/SoundChexiOS, etc.); the
seeder does not. Titles/types for imported items are best-effort and can be
polished in the panel. Nothing is published by the import — only the seeder's
curated set is on the public roadmap.
