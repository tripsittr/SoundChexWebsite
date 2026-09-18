<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // The full tracked backlog (imported from the repos' Markdown trackers,
        // now the source of truth). ItemsSeeder covers the published roadmap too,
        // so RoadmapSeeder is only needed on its own.
        $this->call(ItemsSeeder::class);
        $this->call(ContentSeeder::class);
    }
}
