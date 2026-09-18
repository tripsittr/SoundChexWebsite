# 020 — Retire the Markdown issue docs; DB is the source of truth (W-31)

*2026-09-18.*

## Done

- Verified the import is complete: **248/248** source refs across all six repos
  are in the tracker (zero misses), with full descriptions intact.
- **`ItemsSeeder` + `database/seeders/data/items.json`** — the full backlog (253
  items) exported to versioned JSON and seeded from it, so the database is
  reproducible from git without needing `items:import` (which reads the sibling
  repos). Registered in `DatabaseSeeder`.
- **`Issues.md` retired** in every repo — replaced with a short pointer to the
  admin **Tracker** (`/admin`) and `php artisan track:issue`, noting the history
  was imported and is reproducible from the JSON. (The other repos' pointers are
  committed in their own repos.)

## Why

Per the plan to make the admin panel the single source of truth for project
tracking across all SoundChex platforms. Nothing is lost — the Markdown content
lives in the tracker and in `items.json`.
