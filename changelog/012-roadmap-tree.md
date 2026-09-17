# 012 — Roadmap as a branching tree (W-24)

*2026-09-17.*

## Done

- Redesigned `/roadmap` from a flat list of blocks into a **branching tree**: a
  "SoundChex" root at the top, a central trunk, and each platform group as a
  branch node connecting left/right (alternating) off the trunk, with each
  feature a leaf connected by a short elbow.
- Per-group icons; status dots keep a soft ring in their status colour.
- Connectors are pure CSS borders (no SVG, no script) and are hidden below `lg`,
  so mobile collapses cleanly to a single centred column of cards.

## Why

The block list read as monotonous and didn't convey the "one server branches to
every device" shape. The tree does, and looks the part.
