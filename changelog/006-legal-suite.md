# 006 — The legal suite (W-06)

*Commit `0c73bde`, 2026-09-17. Retroactive (see 007).*

## Done

- 17 documents + `/legal` hub: website Terms / Privacy / **Cookie Policy**
  (complete two-cookie inventory, why there's no banner), Server Terms /
  Privacy ("the server sends nothing to Tripsittr LLC, ever"), and per-
  platform app Terms + Privacy ×6 via shared components with
  platform-specific storage paths, deletion steps, and store declarations
  (Apple "Data Not Collected", Play "no data collected / no data shared").
- Standing principle encoded everywhere: zero trackers, zero collection; no
  user data outside SCNet; SCNet limited to the legally and functionally
  required minimum, with its subscriber terms promised before first
  subscriber.
- `/privacy` and `/terms` redirect into the hub; footer gained Cookies and
  All-legal. Unreleased platforms publish their documents ahead, badged.
- Tests: hub links all 17; each renders with operator + draft notice;
  privacy pages assert the zero-collection language; old URLs redirect.

## Still open

- Counsel review (W-14). Every page carries "Draft pending legal review".
- The documents are now public promises — treat them as product spec
  (noted in AGENTS.md cross-repo sync).
