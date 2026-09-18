# 023 — Trello/Jira board for the tracker (W-29)

*2026-09-18.*

## Done

- **Kanban board** (`/admin` → **Board**) — a custom Livewire/Alpine page with
  SortableJS. Columns are statuses; cards show the title, ref, type, platform,
  and an on-roadmap tick. Fully in the SoundChex theme.
- **Drag a card between columns** → updates its status (persisted).
- **Drag a column by its header handle** → reorders the board (persisted per
  session).
- **Click a card** → opens the pretty slide-over item view (the same
  `ItemInfolist`), with a Close button.
- **Platform filter chips** across the top.
- **Status rename for clarity:** `available` now shows as **"Shipped"** in the
  admin (public-facing complete: users have it, on the roadmap), distinct from
  **"Done"** (internal complete: closed ticket, not on the roadmap). The public
  `/roadmap` still labels the shipped tier "Available" for visitors. Stored
  values are unchanged.

## Notes

The board keeps the existing table view (great for search/filter/bulk-edit).
The "Done" column is capped (recent + "+N more") since 159 items are done.
Verified in-browser: card drag, column drag (both persist after reload), and
card-click slide-over.
