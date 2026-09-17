# 004 — Sidebar-driven documentation hub (W-04)

*Commit `ba03699`, 2026-09-17. Retroactive (see 007).*

## Done

- Replaced the single /docs link map with 22 pages: getting started ×3,
  per-OS server installs (macOS / Windows / Linux), libraries, metadata,
  workers, remote access, moving & backups, one app page per device ×6,
  profiles, search, offline, customization, troubleshooting.
- Emby-style structure in our skin: card-grid index, sticky sidebar
  (disclosure on phones) with current-page highlight, `.doc-prose` styles on
  the brand tokens, note/warn callouts.
- Slug-routed `/docs/{slug}` against a view-exists whitelist; unknown slugs
  404. Footer/home links repointed at real pages.
- Content drawn from the app repo's own docs (SettingUpOnWindows,
  BuildingOnEachPlatform, RemoteAccess, MovingAServer, UsersAndProfiles);
  unshipped platforms badged honestly.
- Tests: every sidebar page renders, sidebar links them all, traversal
  slugs 404.

## Still open

- Integrations and remote-access user guides marked "in progress" on their
  pages (W-17).
