# The download page offers the beta, and says what it is

W-34, alongside S-421.

The first public release is out: `client-v0.2.0-beta.1` and
`server-v0.2.0-beta.1`, 0.2.0 "Rough Cut".

## Pinned to the tag, not "latest"

Every download link pointed at `releases/latest`. GitHub does not count a
pre-release as "latest", so with a beta as the only release those links would
have 404'd — a download page whose every button is broken.

They now name the tag. When a stable release exists, `latest` is right again
and these go back.

## `ready` is not `tested`

The runtime table had one flag, and it conflated two questions: can this be
downloaded, and has anyone run it. Windows and Linux now build and package
correctly, so they are downloadable — and nobody has started either of them.

Those rows are marked **Untested** rather than quietly offered, and a banner
above the whole page says it once in full:

> macOS is used daily; Windows and Linux compile in CI and have not yet been
> run on those systems — they are here to be tested, not relied on.

A badge on a row is easy to miss. The warnings these builds produce are not,
so the banner also explains them: macOS calls an unsigned app *damaged* rather
than merely unidentified, and Windows SmartScreen blocks it. Both need a
specific gesture to get past, and someone who has not been told assumes the
download is broken.

## A test bug this turned up

The suite failed 11 times on a clean checkout — nothing to do with this page.
The tracker CLI writes to the live site when `TRACKER_REMOTE_*` is set (W-33),
and tests inherited that: they mutated the real tracker and then asserted
against a test database that had never seen the change.

`phpunit.xml` now clears both, rather than depending on whoever runs the tests
not having a remote configured.
