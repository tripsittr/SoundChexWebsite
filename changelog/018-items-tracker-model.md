# 018 — Shared items model + tracker resource + track:issue (W-29)

*2026-09-18.*

## Done

- **`items` table + `Item` model** — one shape for todos, issues and public
  roadmap entries: `title`, `description`, `platform`, `repo`, `type`
  (feature/bug/todo/chore), `status` (planned/in-progress/available/done/
  deferred), `priority`, `published`, `ref` (original tracker id), `public_summary`,
  `sort_order`. Promoting a todo/issue to the roadmap = flipping `published`.
- **Filament resource** ("Tracker" in the nav) — full form (grouped What / Where /
  Roadmap), a table with badges and filters (platform, status, type, repo,
  published), and a nav badge counting internal (unpublished) items.
- **`php artisan track:issue`** — add an item from the console: fully interactive
  (Laravel Prompts) with no args, or pass options to skip prompts
  (`--platform`, `--type`, `--status`, `--repo`, `--ref`, `--publish`, …).
  Validates enum flags and reports what it created.

## Next

W-30 — the public /roadmap reads published items from the DB; then seed all the
existing issues/plans from every repo's Markdown trackers (W-31 area).
