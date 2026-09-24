# 035 — track:issue validates --repo

**Merged** 2026-09-24 · **Issues** W-370

`--repo` was the one enum flag nobody validated. `--platform`, `--type`,
`--status` and `--priority` all refuse an unknown value; `--repo` took
whatever it was given, so a typo stored a string no lookup would ever match
and the item quietly belonged to no repo at all.

## What changed

The value is checked against `Item::REPOS` and a bad one exits 1 without
writing, the same as every other flag.

Empty stays allowed on purpose: the column is nullable and a cross-cutting
item genuinely has no single repo.

## Worth knowing

**Nothing existing is rejected.** All 364 rows were checked before making the
change: every stored `repo` is a valid `REPOS` key, and the one null row is
legitimate. This was raised as a possible risk of fixing it — the data says
there is none.

## Still wrong

Nothing found here.

## Tests

PHP · 47/47, up from 45. Two new: an invalid repo fails without writing, and
an item with no repo is still allowed.

Pint `--dirty` run per `AGENTS.md`; clean.
