# 013 — Fix stale MIT references (site copy + legal) (W-25)

*2026-09-17.*

## Done

The site still said **MIT** in several places after the move to AGPLv3. Updated
everywhere, keeping the tone:

- **Marketing/docs copy** (factual swaps): the footer ("SoundChex is
  AGPLv3-licensed…"), the home pricing + "open source" sections, and the
  `github-setup` / `introduction` docs pages.
- **Legal documents** (substantive, not a word swap — MIT is permissive, AGPLv3
  is copyleft with a network clause): rewrote the licence sections in the shared
  `app-terms` component (covers macOS/Windows/Linux/iOS/iPadOS/Android app
  terms), `server-terms`, and `website-terms` to state AGPLv3 and its §13
  network-source obligation; updated the per-platform "applies alongside … the
  licence" lines and the no-warranty / "the licence wins" clauses.
- Regenerated all 17 legal PDFs (`build-legal-pdfs.sh`) so the committed PDFs
  match — verified the AGPL text is present in the output.

## Why

The licence changed to AGPLv3 across all platforms; the site's own claims had to
follow, and the legal suite's rule is to update the document (and its PDF) first.
The legal docs kept their **draft-pending-review** status — the wording is
correct but still awaits counsel sign-off.
