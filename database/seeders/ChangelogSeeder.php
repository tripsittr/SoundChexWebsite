<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Database\Seeders;

use App\Models\ReleaseNote;
use Illuminate\Database\Seeder;

/**
 * Seeds the public changelog from the whole shipped history — condensed and
 * grouped from the per-PR `changelog/NNN-*.md` dev entries (app + website) into
 * readable, platform-tagged public notes. Idempotent (keyed on title). Edit or
 * add entries in the admin panel (Content → Changelog) going forward.
 */
class ChangelogSeeder extends Seeder
{
    public function run(): void
    {
        // Newest first. `sort_order` is assigned by position (highest = newest)
        // so same-day entries keep this order on the page.
        $notes = [
            [
                'version' => null,
                'title' => 'Bundled server runtime — plug-and-play self-hosting',
                'platform' => 'server-desktop',
                'released_on' => '2026-09-18',
                'body' => 'The server is becoming a single download — **PHP, php-fpm and Caddy** in one '.
                    "relocatable bundle, no system PHP or Herd required.\n\n".
                    '- Runtime bundles now build for **macOS, Linux (x86_64 & ARM64)** — get them on the '.
                    "[download page](/download).\n".
                    "- Upload limits are ours now: a **25 MB** cap replaces the old 2 MB dev-server limit.\n".
                    '- Windows packaging is in progress.',
            ],
            [
                'version' => null,
                'title' => 'Open-sourced under AGPLv3',
                'platform' => 'meta',
                'released_on' => '2026-09-18',
                'body' => 'SoundChex is now open source under the **GNU AGPLv3** on every platform, with a '.
                    'commercial licence available for those who need it. Every dependency was licence-audited, '.
                    'and the projects we build on are credited on the [credits page](/docs/credits).',
            ],
            [
                'version' => '0.4.1',
                'title' => 'iOS “Interlude” — playlists, search & fixes',
                'platform' => 'ios',
                'released_on' => '2026-09-17',
                'body' => "- A **persistent search + account header** on every page.\n".
                    "- **Spotify-style playlists** in Music: create, rename, cover art, drag-to-reorder, play/shuffle.\n".
                    "- **Batch “download all”** and incremental library sync.\n".
                    '- Cover-upload and layout fixes.',
            ],
            [
                'version' => null,
                'title' => 'Spotify-style playlists on web & desktop',
                'platform' => 'server-desktop',
                'released_on' => '2026-09-17',
                'body' => 'Playlists got a Spotify/Apple-style overhaul everywhere — cover images, '.
                    'descriptions, drag-to-reorder, and a proper play/shuffle header — backed by a new '.
                    '**playlist API** shared by every client.',
            ],
            [
                'version' => null,
                'title' => 'Server settings & config from the admin panel',
                'platform' => 'server-desktop',
                'released_on' => '2026-09-17',
                'body' => 'Configure the server from the panel instead of hand-editing files, and generated '.
                    'links now match the address the request actually came in on — so remote access stops '.
                    'handing out `localhost` URLs.',
            ],
            [
                'version' => null,
                'title' => 'Offline downloads & playback on iOS',
                'platform' => 'ios',
                'released_on' => '2026-09-15',
                'body' => 'Download tracks to the device and play them back with no server in reach — real '.
                    'native storage with **actual free-space numbers**, so a “download all” knows when to stop. '.
                    'Built in layers over several releases and now playing offline on the device.',
            ],
            [
                'version' => null,
                'title' => 'Two admin tiers, and a tightened panel',
                'platform' => 'server-desktop',
                'released_on' => '2026-09-12',
                'body' => 'Separate **library** and **server** admin tiers, a floor on who can reach the panel, '.
                    'a repo-path and endpoint hardening pass, and a library-cleanup that catalogues what it '.
                    'actually needs to.',
            ],
            [
                'version' => null,
                'title' => 'Integrations — richer metadata sources',
                'platform' => 'integrations',
                'released_on' => '2026-09-11',
                'body' => 'Wired up external metadata and subtitle sources (including an OpenSubtitles key), a '.
                    'listening-history record, and per-reader book progress — the groundwork for smarter '.
                    'catalogue data.',
            ],
            [
                'version' => null,
                'title' => 'The catalogue download & library scanning',
                'platform' => 'server-desktop',
                'released_on' => '2026-08-23',
                'body' => 'The library catalogue can be pulled down and kept in step, scans stopped re-cataloguing '.
                    'the whole library every time, duplicates resolve to a single surviving copy, and television '.
                    'stopped being filed as film.',
            ],
            [
                'version' => null,
                'title' => 'Server-to-server library transfer',
                'platform' => 'server-desktop',
                'released_on' => '2026-08-22',
                'body' => 'Move a whole library to another machine: a resumable transfer that says where it is, '.
                    'survives cancellation and retries, only lands files where they are allowed to go, and '.
                    'cleans up after itself — the foundation for moving a server between machines.',
            ],
            [
                'version' => null,
                'title' => 'Artist credits, profiles & offline recovery',
                'platform' => 'server-desktop',
                'released_on' => '2026-08-22',
                'body' => 'Artist credits and profiles, the first offline-recovery groundwork, and a way to '.
                    'track what each change teaches — the earliest public milestone.',
            ],
        ];

        $count = count($notes);
        foreach ($notes as $i => $n) {
            ReleaseNote::updateOrCreate(
                ['title' => $n['title']],
                array_merge($n, ['published' => true, 'sort_order' => $count - $i]),
            );
        }
    }
}
