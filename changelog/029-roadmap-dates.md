# 029 — Dates on roadmap entries (W-36)

*2026-09-18.*

## Done

Each roadmap entry now shows its **last-updated date** — the `updated_at` from the
admin panel — beside the status badge, so readers can see how fresh each item is.

- The date comes straight from the Item's `updated_at` (formatted `M j, Y`), so
  editing an entry in Filament moves its date on the public roadmap.
- The curated empty-DB fallback (entries with no date) is padded so the
  destructure never warns.

## Notes

Copy/layout only; 17 tests pass. Rendered: 18 dated entries on /roadmap.
