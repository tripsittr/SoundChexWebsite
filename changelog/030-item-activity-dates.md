# 030 — Real roadmap dates from git + status changes (W-37)

*2026-09-18.*

## Done

The roadmap dates were all "today" (the backlog was seeded today), which is a
useless freshness signal. Fixed properly:

- **New `activity_on` date on items** — the date an item's **status** last
  changed, which is what the roadmap shows.
- **Backfilled from git** — `php artisan items:date-from-git` finds when each
  item's ref (S-52, W-12, IOS-08) first appeared across the app + website repos
  and takes the earliest commit date. All 253 items dated, 0 misses; the spread
  is now Jun–Sep, not all today.
- **Advances on status change** — a model hook sets `activity_on` to today
  whenever `status` becomes dirty (and on create). Editing the wording or any
  other field does NOT move it. Three tests cover this.
- The roadmap now renders `activity_on` (falling back to `updated_at`).

## Notes

The git backfill uses `saveQuietly` so it doesn't trip the status hook or bump
`updated_at`. 20 tests pass.
