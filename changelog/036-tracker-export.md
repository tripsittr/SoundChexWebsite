# Tracker backup: export on deploy and from the panel

W-32.

The tracker is the only record of the roadmap, and since the move to Forge it
lives in a single SQLite file on a single droplet. Losing that droplet loses the
roadmap. This adds two exits, deliberately aimed at different failures.

## A snapshot before every migration

`deploy/forge-deploy.sh` runs `php artisan track:export` immediately before
`migrate --force`. The moment a migration is about to touch the schema is
exactly when a restore point is worth having. The snapshot lands in
`storage/backups/`, which Forge shares across releases, so it outlives the
deploy that wrote it.

It is deliberately non-fatal — `|| echo "Snapshot failed — continuing."`. A
deploy that stalls because a backup failed leaves the site on the old release
with no fix shipped, which is worse than a deploy with one missing snapshot.

Files are stamped to the minute (`tracker-2026-09-25_143012.json`), so two
deploys in an afternoon leave two restore points rather than overwriting each
other, and `--keep` (default 20) prunes the oldest.

## An Export button in the Board header

A copy that never leaves the droplet does not protect against losing the
droplet. The Board page now has an Export action that streams the same JSON
straight to the operator's machine, ready to commit somewhere durable.

## Shape

`App\Services\TrackerExport` builds both, so the file on the server and the file
in the browser are byte-identical. It carries a `version` field, bumped when the
shape changes, so a future restore can tell what it is reading. Items are
ordered by id and the JSON is pretty-printed — a snapshot that is committed to
git should diff cleanly against the last one.

## Not included

There is no import/restore command yet. The snapshot is a JSON array of rows
with stable keys, so a restore is a short tinker script, but a `track:import`
with conflict handling is a separate piece of work.

`storage/backups` is gitignored. The copy meant for git is the one downloaded
from the panel and committed deliberately, not whatever the last deploy left on
the server.

## Self-review

Two things came out of reading it back. The timestamp comment said "to the
minute" while the format string was to the second — the comment was wrong, not
the code, and it now also records *why* the format matters (it is lexically
sortable, which is what lets pruning order by filename rather than trust mtimes
a deploy may have rewritten).

The second is a test. `prune()` runs unattended on every deploy and works by
globbing a directory and deleting, so its blast radius is worth pinning down:
an operator's own file sitting alongside the snapshots must survive. Widening
the glob to `/*` makes that test fail, which is the check that it is testing
something real.
