<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Database\Seeders;

use App\Models\ReleaseNote;
use Illuminate\Database\Seeder;

/**
 * Seeds a starter public changelog — the user-facing milestones, not the
 * granular internal `changelog/NNN-*.md` files. Idempotent (keyed on title).
 * Edit and add entries in the admin panel (Content → Changelog) going forward.
 */
class ChangelogSeeder extends Seeder
{
    public function run(): void
    {
        $notes = [
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
                'title' => 'Full playlist editing across web, desktop & iOS',
                'platform' => 'server-desktop',
                'released_on' => '2026-09-17',
                'body' => 'Playlists got a Spotify/Apple-style overhaul everywhere — cover images, '.
                    'descriptions, drag-to-reorder, and a proper play/shuffle header — backed by a new '.
                    'playlist API shared by every client.',
            ],
            [
                'version' => null,
                'title' => 'Open-sourced under AGPLv3',
                'platform' => 'meta',
                'released_on' => '2026-09-17',
                'body' => 'SoundChex is now open source under the **GNU AGPLv3** on every platform, with a '.
                    'commercial licence available for those who need it. See the [credits](/docs/credits) '.
                    "for the projects we're built on.",
            ],
            [
                'version' => '0.2.0',
                'title' => 'The native iOS app arrives',
                'platform' => 'ios',
                'released_on' => '2026-09-16',
                'body' => 'A ground-up native Swift app for iPhone and iPad: sign-in, browse, playback, '.
                    'offline downloads, playlists, admin and lyrics — with background audio and Picture in Picture.',
            ],
        ];

        foreach ($notes as $i => $n) {
            ReleaseNote::updateOrCreate(
                ['title' => $n['title']],
                array_merge($n, ['published' => true, 'sort_order' => count($notes) - $i]),
            );
        }
    }
}
