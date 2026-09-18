# 015 — Real logos + platform frameworks on the credits page

*2026-09-17.*

## Done

- **Real logos** in the "Built on" marquee, replacing the monogram tiles: each
  framework's actual logo, self-hosted as a single-colour SVG
  (`public/images/credits/`, from Simple Icons — CC0), used as a CSS mask and
  painted in the brand colour on a light tile. getID3 has no logo, so it keeps a
  monogram.
- **Platform frameworks added** so the marquee reflects the whole vision, not
  just the current web/desktop stack: **Swift** (iOS/iPadOS/tvOS), **Kotlin** +
  **Jetpack Compose** + **Android** (Android/TV/Fire TV), and **Roku**. The
  heading now reads "the languages, frameworks and tools SoundChex is built with
  — … and the ones we're building next".
- **Spacing fix:** the dependency tables had their first column against the
  section's left border. Padding moved to the table wrapper (`px-5`) so every row
  clears the border consistently.

## Notes

Logos are self-hosted SVGs (no external image requests — CSP-safe). Simple Icons
is CC0, so no attribution is required; provenance recorded here. The logos are
used to credit each project, which is the page's purpose.
