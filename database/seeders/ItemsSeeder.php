<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

/**
 * Seeds the full tracked backlog from `database/seeders/data/items.json`.
 *
 * This JSON is the exported snapshot of every item that was imported from the
 * repos' Markdown trackers (via `items:import`) plus the published roadmap. Once
 * the Markdown Issues docs are retired, this file — versioned in git — is how a
 * fresh database is rebuilt, so `items:import` (which reads the sibling repos) is
 * no longer required.
 *
 * Idempotent: keyed on `ref` where present.
 */
class ItemsSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/items.json');
        if (! is_file($path)) {
            $this->command?->warn("items.json not found at {$path}");

            return;
        }

        $items = json_decode(file_get_contents($path), true) ?? [];

        foreach ($items as $row) {
            if (! empty($row['ref'])) {
                Item::updateOrCreate(['ref' => $row['ref']], $row);
            } else {
                // No ref → identify by title + platform to stay idempotent.
                Item::updateOrCreate(
                    ['title' => $row['title'], 'platform' => $row['platform']],
                    $row
                );
            }
        }

        $this->command?->info('Seeded '.count($items).' items.');
    }
}
