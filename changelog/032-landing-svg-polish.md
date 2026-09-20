# 032 — SVG polish on the landing page

*2026-09-19.* · **Issue** W-267 / S-267

## Done

Two pieces of the landing page gain artwork, no external assets or designer
needed.

### Platform strip

The "Runs where you do" tiles now carry a **monochrome platform glyph** (Apple,
Android, Windows, Linux, with a generic device fallback) above each name, tinted
`text-ink-100` when available and muted when coming soon. `<x-platform-icon>`
matches on the platform name the Platforms model stores, so a new platform gets
the generic glyph rather than a blank.

### Feature illustrations (slot)

The feature cards are wired for **unDraw illustrations** (undraw.co, open licence,
the Jellyfin look). `<x-feature-illustration>` inlines
`resources/illustrations/{name}.svg` and swaps unDraw's recolourable `#6C63FF`
for the SoundChex accent via `currentColor`, so the tint follows the theme. A
missing file renders nothing, so the cards degrade cleanly until the art is
dropped in.

## Worth knowing

- **The illustration SVGs are not committed yet** — drop the six files
  (`catalogue`, `metadata`, `search`, `read`, `offline`, `compatible`) into
  `resources/illustrations/` (see its README for the unDraw search terms) and they
  render automatically. The cards look correct without them in the meantime.
- Platform glyphs are inline `currentColor` paths, so they cost no requests and
  match the theme; verify their rendering in the browser.

## Tests

None — layout/asset only (no behaviour or logic changed). `npm run build` clean;
the home route renders 200 with the platform glyphs inlined.
