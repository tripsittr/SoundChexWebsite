# 001 — Initial site (W-01)

*Commit `da2a1cc`, 2026-09-17. Written retroactively when the changelog
convention was adopted (007).*

## Done

- Laravel 13 + Tailwind v4 + Livewire 4 scaffold (Boost installed), brand
  tokens imported from the app repo's `tokens.css`, Figtree via bunny plugin.
- Landing page: hero with waveform motif, honest platform row (macOS/iOS
  real, four "coming soon"), six feature cards from the README, profiles
  strip, two-column pricing (Self-hosted free / **SCNet** coming soon),
  open-source + donations section with the six-line quickstart, full footer.
- SCNet waitlist: Livewire SFC, validated + lowercased emails, unique rows in
  `waitlist_signups` (SQLite). Tests for join/invalid/duplicate.
- Single-page docs link map at /docs; draft privacy + terms pages.
- Site linked in Herd at https://soundchex.test (after clearing a stale
  `SoundChex` symlink pointing at a pre-move repo path).

## Still broken / not done

- Sponsor button and release download links point at not-yet-activated
  GitHub features (later W-08/W-13).
- Docs and policies were placeholders by depth — superseded in 004 and 006.
