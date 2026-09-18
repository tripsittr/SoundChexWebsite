# 028 — Legal copy caught up to what the product does (W-35)

*2026-09-18.*

## Done

A compliance audit found the legal copy had drifted from what the site and
software now actually do. Fixed the concrete inaccuracies:

- **Privacy — the "no third-party requests / talks only to us" claim was false.**
  The download and source links point to GitHub, so clicking one does reach a
  third party. Reworded to: our *pages* embed no third-party trackers/CDNs/
  widgets, and the only third-party request is a link you choose to click
  (download / source → GitHub, with a pointer to GitHub's privacy statement).
- **Terms — the commercial license was mentioned nowhere** while the terms called
  the AGPLv3 "the complete and only license." Added a clause (website + server
  terms) stating a paid commercial license is available as an alternative, with
  the AGPLv3 governing unless one is held.
- **Terms — the bundled third-party runtime was undisclosed.** Added a clause
  naming the bundled components (PHP, Caddy, SQLite, Mozilla CA bundle) and that
  they keep their own licenses (see the shipped `THIRD-PARTY-LICENSES`).
- **Terms — no governing law.** Added an Arizona / Maricopa County
  governing-law + venue clause to the website terms.

## Notes

Rendered all three pages (200) and confirmed the new clauses; 17 tests pass.
The AGPLv3 §13 source-offer gap (source link missing from the served app) was
fixed separately in the app repo (changelog/090 there).
