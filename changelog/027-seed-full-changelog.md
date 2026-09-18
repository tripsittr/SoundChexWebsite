# 027 — Seed the public changelog from the whole history (W-34)

*2026-09-18.*

## Done

The public `/changelog` had only 4 curated entries while ~86 per-PR dev
changelog files (app + website) recorded the real shipped history. Expanded the
`ChangelogSeeder` to cover the **whole history, condensed** — grouped the dev
entries into readable, platform-tagged public notes spanning Aug 22 → Sep 18:
server-to-server transfer, catalogue/scanning, integrations, admin tiers,
offline downloads on iOS, playlists on every client, server config, AGPLv3, and
the bundled runtime.

## Notes

- Dates come from each dev entry's git-add date, so the timeline is accurate.
- Idempotent (keyed on title); `updateOrCreate` so re-seeding refreshes bodies.
- This is the *condensed* public view — the granular `changelog/NNN-*.md` dev
  history stays in the repos. Add/edit going forward in the admin panel
  (Content → Changelog).
- 17 tests pass.
