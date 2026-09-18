# 014 — Open-source credits page (W-26)

*2026-09-17.*

## Done

- New `/docs/credits` page — **Open-source credits** — thanking and crediting
  every third-party dependency SoundChex ships: **822 packages** across PHP
  (Composer, 147), JavaScript (npm, 152) and Rust (Cargo, 523), each with its
  name, version, licence and a link to its home (Packagist / npm / crates.io).
- A **"Built on"** marquee of curated monogram tiles for the ecosystems and
  frameworks we lean on most (Laravel, PHP, Filament, Livewire, Tailwind, Vite,
  Alpine, Tauri, Rust, getID3, Symfony, SQLite) — self-hosted SVG tiles, no
  external image requests, CSP-safe. Not every package has a logo, so the long
  tail is credited by name + licence.
- Data lives in `resources/data/credits.json`, generated from the app repo's
  dependency manifests (`composer licenses`, npm metadata, `cargo metadata`).
- **Accessible only via the documentation**, as intended: linked from the docs
  index ("About") and the docs sidebar. Not in the site nav or footer.

## Why

Crediting the projects we depend on is both good manners and part of honouring
their licences. Every licence listed is compatible with SoundChex's own AGPLv3
(see the app repo's LicenseAudit.md).
