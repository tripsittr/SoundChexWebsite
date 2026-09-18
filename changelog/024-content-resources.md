# 024 — Manage the rest of the front-end data (W-31)

*2026-09-18.*

## Done

A "Content" nav group in the admin panel for the remaining editable front-end
data:

- **SCNet waitlist** — view the signups collected by the landing form, search,
  and **Export CSV** (a simple streamed download; no export-tables setup). Delete
  in bulk. Nav badge shows the count.
- **Platforms** — the home "Runs where you do" grid, now DB-driven. Each platform
  has a name and an **available** toggle (Download vs "Coming soon"); the list is
  drag-reorderable. Seeded with the current 12 platforms; the home page reads
  from here (with a rescue() fallback to a default list before migration).
- **Credits marquee** — the "Built on" tiles on `/docs/credits`, now DB-driven:
  name, role, url, brand colour, logo slug (or monogram). Drag-reorderable.
  Seeded with the current 17 frameworks; the credits page reads from here.

- **`ContentSeeder`** reproduces platforms + frameworks from git; registered in
  `DatabaseSeeder`.

## Notes

Home and credits use `rescue()` so a fresh install before migration falls back to
sensible defaults rather than erroring. 17 tests pass. Verified the three
resources load and render in the panel.
