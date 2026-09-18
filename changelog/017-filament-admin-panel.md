# 017 — Filament admin panel + auth (W-28)

*2026-09-18.*

## Done

- Installed **Filament v5** and a panel at `/admin` (`AdminPanelProvider`).
- **Admin auth:** `users.is_admin` (migration), `User` implements `FilamentUser`
  and gates `canAccessPanel()` on `is_admin`. Single admin for now; the gate's
  shape supports roles later (Filament Shield) without rework.
- Seeded the admin user (`blaze.claeson@gmail.com`, temporary password — change
  it on first login).

## Why

The backend for managing all front-end data — the shared todos/issues/roadmap
items (W-29), the SCNet waitlist, platform availability and the marquee (W-31).
Ultimately the single source of truth for project tracking across every SoundChex
repo, replacing the Markdown Issues docs.

## Next

W-29 — the shared `items` model + Filament resource + a `track:issue` CLI command.
