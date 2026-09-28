# An age suitability page

W-35. Written for the Apple submission, which asks an age rating to be
justified, and linkable from the app's store listing.

## What it says

SoundChex ships no content. Installed and never connected it shows a screen
asking for a server address, and that is the whole of it — no advertising, no
purchases, no user-generated content, no browser, no way to reach anyone else's
library.

What it *does* ship is the controls. The app's own admin section creates
household profiles, caps a profile at a content rating, and sets a PIN on the
ones that are not capped — without leaving the app. So this is not "the server
handles that": the parental controls are a feature of the app being rated.

The rating ladder is listed as the code defines it, from `G` through `NC-17`,
with the cap allowing everything at or below it.

## What it admits

A filter people trust incorrectly is worse than no filter, so the page is
explicit about the limits:

- **Unrated titles pass.** Most music and most books carry no rating, and
  excluding everything unrated would empty a child's library rather than
  protect it. That is a deliberate choice in `ContentGate`, and parents should
  know it.
- Ratings come from metadata, not from inspecting the file.
- The cap is only as good as its PIN.
- Downloads already on the device play without the server, and without its
  rules.

## Where it is

`/legal/age-suitability`, listed on the legal index and in the sidebar beside
the other cross-platform documents. The slug route picks it up with no route
change.
