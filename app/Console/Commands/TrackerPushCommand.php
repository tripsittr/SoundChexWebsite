<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Console\Commands;

use App\Models\Item;
use App\Services\TrackerClient;
use Illuminate\Console\Command;
use RuntimeException;

use function Laravel\Prompts\confirm;

/**
 * Pushes this machine's tracker to the live one (W-33).
 *
 * Written for a specific mess: work was logged into a local copy of the
 * tracker while the board the owner actually reads sat on the droplet, and
 * nothing synced them. This is how the local history gets to the server
 * without renumbering anything.
 *
 * Ids are preserved. Changelogs, commit messages and issue descriptions across
 * three repositories refer to items by number, so a renumbering import would
 * quietly break every cross-reference in the project.
 */
class TrackerPushCommand extends Command
{
    protected $signature = 'tracker:push
        {--dry-run : Say what would be sent, and send nothing}
        {--force : Skip the confirmation}';

    protected $description = 'Push this machine\'s tracker items to the live tracker';

    public function handle(): int
    {
        $client = TrackerClient::fromConfig();

        if (! $client->isRemote()) {
            $this->error('No remote tracker configured.');
            $this->line('  Set TRACKER_REMOTE_URL and TRACKER_REMOTE_TOKEN in .env.');
            $this->line('  Generate a token with `php artisan tracker:token` on the server.');

            return self::FAILURE;
        }

        $items = Item::query()->orderBy('id')->get();

        if ($items->isEmpty()) {
            $this->warn('Nothing here to push.');

            return self::SUCCESS;
        }

        $this->line("  {$items->count()} items, #{$items->first()->id}–#{$items->last()->id}");
        $this->line("  → {$client->target()}");
        $this->newLine();

        if ($this->option('dry-run')) {
            $this->info('  Dry run — nothing sent.');

            return self::SUCCESS;
        }

        // This overwrites items on the live tracker that share an id, which is
        // the point and also worth saying out loud before it happens.
        if (! $this->option('force') && ! confirm('Overwrite matching items on the live tracker?', default: false)) {
            $this->line('  Cancelled.');

            return self::SUCCESS;
        }

        $payload = $items->map(fn (Item $item): array => $item->only([
            'id', 'title', 'description', 'platform', 'repo', 'type', 'status',
            'priority', 'published', 'ref', 'public_summary', 'sort_order',
        ]))->all();

        try {
            $result = $client->import($payload);
        } catch (RuntimeException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info("  Created {$result['created']}, updated {$result['updated']}.");
        $this->line("  The live tracker now holds {$result['total']} items.");

        return self::SUCCESS;
    }
}
