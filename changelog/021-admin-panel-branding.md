# 021 — Brand the admin panel to match SoundChex (W-28)

*2026-09-18.*

## Done

- **SoundChex theme** for the Filament panel: forced dark mode, the brand accent
  (#d95145) as the primary colour ramp, the base/ink palette from the site's
  `tokens.css` mapped onto Filament's neutral surfaces (near-black grounds, soft
  ink text, brand-tinted borders), Figtree font, the SoundChex wordmark as the
  brand logo, and the site favicon. Theme CSS at
  `resources/css/filament/admin/theme.css`, built via Vite.
- **Dashboard overview widget** (`TrackerOverview`) — tracked items, on-roadmap
  (published) count, and in-progress / planned / done — replacing the default
  Filament info widget.
- Nav label "Tracker" with an internal-item count badge.

## Verified

Logged in and screenshotted the dashboard and tracker list — the panel reads
like the rest of the product (wordmark, accent, dark surfaces).
