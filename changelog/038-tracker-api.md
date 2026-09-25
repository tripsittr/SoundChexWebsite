# Writing to the tracker that people actually read

W-33.

The tracker is the one record of what every SoundChex repository is doing, and
it lives in one SQLite file on one droplet. Work was being logged into a
*local* copy of that file. Nothing synced them and nothing said which one was
being written to, so the board the owner opens fell a session's worth of items
and status changes behind while every command reported success.

## The server owns the data now

A token-authed JSON API on the live site:

- `GET /api/tracker/items` — list, filterable by status and platform, plus
  `?open=1` for the question a tracker is actually asked.
- `POST /api/tracker/items` — add one.
- `PATCH /api/tracker/items/{id}` — change one. A PATCH, not a PUT: the common
  call is moving a card between columns, and making the caller send the whole
  item to do that invites it to send a stale copy of everything else.
- `POST /api/tracker/import` — bulk upsert, ids preserved.

`track:issue` and `track:move` write here when `TRACKER_REMOTE_URL` and
`TRACKER_REMOTE_TOKEN` are set, and to the local file when they are not.

**Both print where they wrote, every time.** That is the actual fix. The
drift was possible because nothing announced the target, so a local write and
a live write looked identical at the prompt.

## The token

One shared bearer token, not accounts: there is one writer, and scopes on a
one-person tracker would be ceremony protecting nothing. Compared with
`hash_equals`, so a wrong token cannot be found a character at a time by
measuring how long the comparison takes.

**Unset means off.** An API that accepts writes because nobody configured a
token is worse than one that is switched off, because the failure is silent and
the damage is in the database. Generate with `php artisan tracker:token`.

## Ids survive the import

`tracker:push` sends the local tracker to the live one keeping every id.
Changelogs, commit messages and issue descriptions across three repositories
refer to items by number — "S-396", "W-32" — and renumbering on import would
break every one of those references without raising a single error.

The import upserts, so running it twice does not double the tracker. Someone
reconciling two databases is exactly the person who will run it twice to be
sure.

## A bug this introduced, and the test that caught it

Routing `track:move` through the client made a no-op move exit non-zero: I had
counted moves and treated zero as failure, conflating "already in that status"
with "no such item". An existing test caught it, and there is now one pinning
the distinction — a batch move where some items are already done must still
succeed.

## Testing

10 new tests for the API, plus one for the exit-code distinction. 67 passing.

Also exercised over real HTTP against `artisan serve`, because the tests mock
nothing but also prove nothing about routing and middleware order: no token
401, wrong token 401, unconfigured 503, create, move, bad enum 422.

## Still to do

- The two databases have not been reconciled yet. `tracker:push` is written and
  tested but needs the token set on the server, which needs SSH access that is
  currently blocked on an unverified host key.
- No delete endpoint. Nothing is deleted from the tracker by policy, so there
  is nothing to expose.
