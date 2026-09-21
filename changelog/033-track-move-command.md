# 033 — `track:move`: change a tracked item's status from the console

Status changes were being made with hand-written `tinker` one-liners against the
`items` table — fine, but not a supported, repeatable path. Now there's a command
for it, the Board's drag from the console.

```
php artisan track:move 285 --to=done
php artisan track:move 285 286 --to=done          # several at once
php artisan track:move 240 --to=in-progress
php artisan track:move 285 --to=done --note="Shipped in PR #167"
php artisan track:move 285                          # prompts for the status
```

- Takes any number of ids; a missing id is reported and the rest still move.
- `--to` is validated against `Item::STATUSES`; omit it and the command prompts.
- `--note` appends a dated line to each item's description.
- A no-op move (already at that status) is reported and does **not** stamp a fresh
  `activity_on` — the roadmap's freshness signal only moves on a real change.

The status is passed through `--to` rather than a positional argument because the
ids are a trailing array, and Symfony forbids a required argument after an array
one.

Documented the command in this repo's `AGENTS.md`/`CLAUDE.md` and in the app
repo's, alongside the existing "drag the card on the Board" instruction.

## Tests

`TrackMoveCommandTest` (8): single and multi-id moves, `--to` and the prompt,
invalid status rejected, missing id reported, activity-date advances on a real
move but not a no-op, `--note` appended and dated.
