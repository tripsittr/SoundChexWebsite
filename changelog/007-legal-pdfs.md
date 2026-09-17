# 007 — Policies as PDFs; legal sidebar by OS (W-07)

*Commit `be243fd`, 2026-09-17. This change also adopted the changelog/issues
workflow itself; entries 001–006 were written retroactively alongside it.*

## Done

- `@media print` stylesheet: light ground, chrome hidden, print typography,
  break rules for tables/callouts.
- `scripts/build-legal-pdfs.sh` renders all 17 legal pages to
  `public/legal-pdf/*.pdf` via Chromium's print pipeline; PDFs are committed,
  so they version with the pages and land on GitHub with the repo (W-12).
- Each legal page's banner links its own PDF; the hub explains where the
  files live.
- Legal sidebar regrouped: one section per OS (Terms + Privacy each) instead
  of a flat 12-item list.

## Rule established

- A legal-page edit is not done until the script is rerun and the PDFs are
  committed with it (in AGENTS.md's definition of done).
