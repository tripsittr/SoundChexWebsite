# 002 — Full wordmark in nav and footer (W-02)

*Commit `c2e7188`, 2026-09-17. Retroactive (see 007).*

## Done

- Trimmed the padded logo PNGs (`magick -trim`) to
  `public/images/logo-*-trim.png`; originals untouched in `assets/`.
- Nav uses the full wordmark at h-10, footer at h-14, replacing the
  icon + text lockup.

## Lesson recorded

- Tailwind v4 compiles only utilities it has seen: the new `h-10`/`h-14`
  classes did nothing (logo rendered full-size) until `npm run build` ran.
  Now part of the definition of done in AGENTS.md.
