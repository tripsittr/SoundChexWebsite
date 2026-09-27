# A README for this repo, not for Laravel

The README was the unmodified `laravel/laravel` skeleton. Everything above the
licence block was scaffolding that had never been replaced: the Laravel logo,
packagist badges describing `laravel/framework` rather than this project, "About
Laravel", Laracasts links, and a Security Vulnerabilities section telling
readers to email **taylor@laravel.com** about SoundChex problems.

Nothing in it said what the repo was. In particular it never mentioned the
**admin Tracker**, which is the issue tracker for *every* SoundChex repository —
both other repos' agent docs send contributors here to run `track:issue`, and
the repo that owns it was silent.

Now documented: the tracker and its commands, the export/snapshot behaviour, the
roadmap, the changelog, the docs hub, the per-platform legal pages, the SCNet
waitlist, real setup steps, and how deploys work.

The licence block was the one part written for SoundChex and is unchanged.

## A note on accuracy

The first draft of this README claimed `php artisan track:import` would seed a
fresh database from a snapshot. There is no such command — which is exactly the
class of error this whole pass was fixing, caught by checking rather than
assuming. The text now says what is true: restoring a snapshot is a short
tinker script until an import command exists.
