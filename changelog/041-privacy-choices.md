# Privacy choices, and the policies caught up to the app

W-36.

## A choices section, on every platform

The policies said what is collected — nothing — but never told anyone what they
could actually control. That is the section Apple and Google both expect, and
its absence reads as an omission rather than as "there is nothing to opt out
of".

It now lists the real controls: which server the app talks to, notifications,
what gets downloaded and for how long, profiles and content caps, diagnostics,
and history. Each with where it lives and what turning it off actually costs.

It ends with the point that matters most here:

> Rights people usually have to ask for — access, portability, deletion — you
> already hold. The data is on hardware you own, in a SQLite file you can copy,
> read or delete without asking anyone, including us.

## Three things the policies had fallen behind on

Found by reading the shipped code against the documents, not by re-reading the
documents.

**Crash diagnostics were unmentioned.** `DeviceReporter` subscribes to MetricKit
and posts to `/api/v1/device-reports`. "No crash reporting to us" was true and
stays true — the reports go to the user's *own server* — but a policy that does
not mention crash reports at all is hiding something, even when the something
is benign. It now says where they go and why.

**"Kids-mode restrictions are enforced by your server" was wrong.** The app
creates profiles and sets rating caps and PINs itself (S-412 era work). The
controls are in the app; the server applies them. Both documents now say so,
which is also the stronger claim for an age rating.

**Notifications and Files-visible downloads were missing.** The app schedules
local notifications for timed downloads (S-405) and now saves downloads where
the person can see and delete them (S-416). Both are privacy-relevant and both
postdated the policy.

## Windows and Linux are no longer "not yet released"

Those four pages carried an "App not yet released" badge. Beta installers for
both shipped in `client-v0.2.0-beta.1`, so the badge was stale.

## Reach

`app-privacy.blade.php` and `app-terms.blade.php` are shared by all six app
platforms, so one edit reaches iOS, iPadOS, macOS, Windows, Linux and Android.
All sixteen legal pages were rendered and checked for a 200 afterwards.
