# Landing feature illustrations (S-267)

Drop unDraw SVGs here, named after the feature:

- `catalogue.svg`  — one catalogue, four media types  (undraw: "music", "media")
- `metadata.svg`   — metadata that fills itself in     (undraw: "organize", "data processing")
- `search.svg`     — search that reaches inside things (undraw: "search", "searching")
- `read.svg`       — reading and watching              (undraw: "reading", "movie night")
- `offline.svg`    — works offline                     (undraw: "download", "sync")
- `compatible.svg` — plays well with others            (undraw: "files", "folder")

The `<x-feature-illustration>` component inlines the file and swaps unDraw's
recolourable `#6C63FF` for the SoundChex accent (via `currentColor`), so the tint
follows the theme. A missing file renders nothing — the card degrades cleanly.
