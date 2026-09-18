# 016 — Fix home-page horizontal overflow on phones (W-27)

*2026-09-17.*

## Done

Audited every page for horizontal overflow at 320–1024px (Playwright). Result:
one bug — the home page overflowed on phones (up to 184px at 320px). Every other
page (download, roadmap, docs, credits, legal) was clean at all widths.

**Cause:** the "Open source, in the open" quick-start `<pre>` code block held a
long, unbreakable line (`git clone https://…`). A grid/flex item defaults to
`min-width: auto`, so the panel refused to shrink below the code's intrinsic
width and pushed the whole page wider than the screen — the `overflow-x-auto` on
the `<pre>` never got a chance to scroll.

**Fix:** `min-w-0` on the code panel column, so it can shrink and the `<pre>`'s
horizontal scroll takes over inside its box. Re-verified 320/375/390/414px clean.

## Note

The site is otherwise responsive across the tested range — the platform grid,
pricing cards, roadmap tree and credits tables all reflow correctly. This was the
one overflow offender.
