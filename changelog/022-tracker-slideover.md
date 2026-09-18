# 022 — Slide-over item view in the tracker (W-29)

*2026-09-18.*

## Done

- Clicking a tracker row now opens a **slide-over** with a clean, read-only view
  of the item (`ItemInfolist`): a header with the title and badged
  Reference / Platform / Type / Status, a Details section with the full
  description, and a Roadmap & meta section (on-roadmap, priority, repo, public
  blurb, order, created/updated). Brand-coloured status/type badges.
- Row click is wired to the `view` action (`recordAction('view')` +
  `recordUrl(null)`), so a single click shows details; Edit is still a row
  action for changes.

## Verified

Logged in, clicked a row, screenshotted the slide-over — renders correctly and
on-brand.
