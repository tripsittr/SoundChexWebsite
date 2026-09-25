<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Console\Commands;

use App\Services\TrackerExport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Writes a tracker snapshot (W-32).
 *
 * Run from the deploy script just before migrations, so every deploy leaves a
 * restore point from the moment before it changed anything — which is exactly
 * when you want one.
 *
 * Snapshots go to `storage/backups`, which survives a zero-downtime deploy;
 * anything written into a release directory is discarded by the next one.
 */
class TrackerExportCommand extends Command
{
    protected $signature = 'track:export
        {--path= : Write here instead of the dated snapshot directory}
        {--keep=20 : How many snapshots to keep}';

    protected $description = 'Write the tracker to JSON, for backup or for committing to the repo';

    public function handle(TrackerExport $export): int
    {
        $json = $export->toJson();
        $explicit = $this->option('path');

        if ($explicit !== null) {
            File::ensureDirectoryExists(dirname($explicit));
            File::put($explicit, $json);

            $this->info("Wrote {$explicit}.");

            return self::SUCCESS;
        }

        $directory = storage_path('backups');

        File::ensureDirectoryExists($directory);

        // Timestamped to the minute, not the day: two deploys in one afternoon
        // should leave two restore points, not overwrite the first.
        $path = $directory.'/tracker-'.now()->format('Y-m-d_His').'.json';

        File::put($path, $json);

        $this->info('Wrote '.basename($path).' ('.number_format(strlen($json)).' bytes).');

        $this->prune($directory);

        return self::SUCCESS;
    }

    /**
     * Keeps the newest N snapshots.
     *
     * Unbounded, a snapshot per deploy fills the disk eventually — and a full
     * disk on a server holding the only copy of the tracker is the failure
     * this command exists to prevent.
     */
    private function prune(string $directory): void
    {
        $keep = max(1, (int) $this->option('keep'));

        $files = collect(File::glob($directory.'/tracker-*.json'))
            ->sortDesc()
            ->values();

        $stale = $files->slice($keep);

        foreach ($stale as $file) {
            File::delete($file);
        }

        if ($stale->isNotEmpty()) {
            $this->line("  Pruned {$stale->count()} older snapshot(s), keeping {$keep}.");
        }
    }
}
