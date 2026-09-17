# 005 — Download hub and installer/GitHub docs (W-05)

*Commit `ba927c6`, 2026-09-17. Retroactive (see 007).*

## Done

- `/download`: SoundChex and SoundChex Server cards, per-platform rows —
  macOS .dmg live via GitHub `releases/latest`, Windows/.exe and Linux
  packages "coming soon", iOS developer build, Android web-app pointer.
- New docs section "Downloads & setup": **GitHub & source setup** (releases,
  watching for versions, updating a source install — migrations called out —
  and reproducing the installers), **macOS setup (.dmg)** (drag-to-
  Applications, Gatekeeper right-click→Open / Open Anyway, honest about
  unsigned builds), **Windows setup (.exe)** (published ahead; SmartScreen
  "More info → Run anyway").
- Every Download entry point (nav, hero, platform strip, footer) routes
  through /download — one place to flip when installers ship.

## Still broken

- `releases/latest` 404s until the first GitHub release with artifacts
  exists (W-13).
