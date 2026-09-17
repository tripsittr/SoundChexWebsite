# 009 — Public product roadmap (W-21)

*2026-09-17.*

## Done

- New `/roadmap` page (`resources/views/roadmap.blade.php`, `roadmap` route),
  linked from the top nav and footer.
- Groups every platform by status — **Available / In progress / Planned** — with
  a legend: server + desktop; iOS/iPadOS/tvOS; Android + Android TV/Google
  TV/Fire TV; smart TVs (webOS/Tizen/SmartCast) + Roku; SCNet; integrations.
- Honest framing ("a direction, not a delivery date") and a link out to the
  GitHub repos where each platform's detailed roadmap lives.

## Why

Pairs with app-repo S-152 (the one-repo-per-toolchain platform strategy). The
per-repo `Roadmap.md` files are the detailed plans; this is the public, at-a-
glance view for users.
