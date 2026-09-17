# 003 — Accent matched to the logo's actual red (W-03)

*Commit `ebc1c63`, 2026-09-17. Retroactive (see 007).*

## Done

- Sampled the wordmark PNG (`magick … histogram:info:-`): the logo's red is
  **#d95145**, not the token's #e11d3a — the token had never matched.
- `tokens.css` (site copy): `--sc-accent: #d95145`, `--sc-accent-hot: #ef6555`.
  Every accent on the site now matches the wordmark exactly.

## Still open

- The app repo's `tokens.css` still carries #e11d3a, so app UI and site
  disagree by a shade (W-16, pairs with an app-side S- issue).

## Context worth keeping

- The request arrived as hex `#2596be` "the red from my logo" — that hex is a
  blue; a color-picker mixup. Sampling the logo file was the fix, not the
  pasted value.
