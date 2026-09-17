# Issues — SoundChex Website

Every feature, fix and content change gets an entry here **before** the work
starts. Website issues are numbered **W-NN**; the app repo uses S-NN, and a
change that pairs with app-side work names its partner issue. Sections run
**In progress → Open → Deferred → Done**. Nothing is deleted.

---

## In progress

*(nothing)*

---

## Open

- **W-08 — Donation platform.** Decide (recommendation: GitHub Sponsors +
  Ko-fi), activate it, and fix the landing page's Sponsor button —
  `github.com/sponsors/tripsittr` 404s until Sponsors is enabled. Add
  `FUNDING.yml` to the app repo (pairs with an S- issue there).
- **W-09 — Real screenshots for the hero.** macOS library view and iPhone
  player, in device frames. The hero currently uses the waveform motif only.
- **W-10 — SVG wordmark + OG image.** The PNGs scale poorly at large sizes and
  the OG image is currently just the app icon. Needs a proper 1200×630 card.
- **W-11 — Domain + production hosting.** Confirm the domain (soundchex.com?),
  pick Forge/VPS or Laravel Cloud, deploy, and point `APP_URL` at it. Site
  currently lives only on Herd at soundchex.test.
- **W-12 — GitHub remote for this repo.** Create the repository, push, adopt
  the PR workflow per AGENTS.md, and update the legal hub note that the PDFs
  are "in the repository" with the real URL.
- **W-13 — First GitHub release with installers.** The download page's buttons
  link `releases/latest`, which 404s until a release exists with the four
  artifacts (SoundChex.dmg, SoundChex Server.dmg; later the two .exe). Pairs
  with app-repo release work. Consider per-asset direct links once real.
- **W-14 — Legal review.** All 17 legal documents carry "Draft pending legal
  review" until counsel signs off. Includes registering a DMCA agent before
  SCNet carries user streams.
- **W-15 — SCNet productization.** Pricing, Cashier/Stripe billing, subscriber
  terms + SCNet privacy notice (the legal hub promises them before first
  subscriber). The waitlist exists; everything else does not.
- **W-16 — Accent token drift.** The site samples the wordmark (#d95145); the
  app's tokens.css still carries #e11d3a, so app UI and site disagree by a
  shade. Fix belongs app-side (pairs with an S- issue); site is the reference.
- **W-17 — Docs pages the site marks "in progress".** A dedicated integrations
  guide, and a fuller remote-access user guide, are promised in the docs.

---

## Deferred

- **W-18 — Cookieless analytics.** Deliberately not doing analytics at all for
  now; the legal suite promises zero trackers. If demand ever justifies it,
  the privacy policy and cookie policy change *first*, publicly.
- **W-19 — Per-asset download links.** Blocked on W-13; `releases/latest` is
  the right target until assets have stable names.

---

## Done

- **W-01 — Landing page.** Hero, platform row (honest badges), six feature
  cards, profiles strip, pricing (Self-hosted free / SCNet coming soon),
  donations + quickstart, footer. Livewire SCNet waitlist storing emails in
  SQLite. *(changelog/001)*
- **W-02 — Wordmark in the nav.** Trimmed the padded logo PNGs so the full
  wordmark is legible at nav size; replaced the icon+text lockup.
  *(changelog/002)*
- **W-03 — Accent matched to the logo.** Sampled the wordmark's actual red
  (#d95145) after the token (#e11d3a) proved to never have matched; hover
  #ef6555. *(changelog/003)*
- **W-04 — Documentation hub.** 22 sidebar-navigated pages replacing the
  single link map: per-OS server installs, libraries/metadata/workers,
  remote access, moving/backups, one app page per device, profiles, search,
  offline, customization, troubleshooting. Slug-routed with 404 whitelist.
  *(changelog/004)*
- **W-05 — Download hub + installer docs.** /download listing both apps per
  platform; docs for GitHub & source setup, macOS .dmg setup (Gatekeeper),
  Windows .exe setup (SmartScreen, published ahead). All download entry
  points route through /download. *(changelog/005)*
- **W-06 — Legal suite.** 17 documents + hub: website terms/privacy/cookies,
  server terms/privacy, per-platform app terms+privacy ×6. Zero-tracking /
  zero-collection principle encoded throughout; /privacy and /terms redirect
  in. *(changelog/006)*
- **W-07 — Policies as PDFs; legal sidebar by OS.** All 17 documents rendered
  print-styled to public/legal-pdf/ with a regeneration script; each page
  banner links its PDF; app policies grouped one sidebar section per OS.
  *(changelog/007)*
