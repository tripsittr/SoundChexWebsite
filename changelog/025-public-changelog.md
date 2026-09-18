# 025 — Admin-managed public changelog (W-32)

*2026-09-18.*

## Done

- **Public `/changelog`** — a timeline of release notes (version badge, title,
  date, platform, markdown body), linked from the nav and footer. `rescue()`
  fallback so a pre-migration install doesn't error.
- **Admin resource** (Content → **Changelog**) — create/edit release notes with a
  markdown editor, version, platform, date and a `published` toggle.
- `ReleaseNote` model + migration; `ChangelogSeeder` with a curated starter set
  of user-facing milestones (not the granular internal changelog files),
  registered in `DatabaseSeeder`.

## Notes

This is the *public, curated* changelog — distinct from the per-repo
`changelog/NNN-*.md` dev history. Add entries in the admin panel going forward.
17 tests pass.
