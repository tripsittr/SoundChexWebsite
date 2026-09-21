<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;

/**
 * Move tracked items to a new status from the console — the Board's drag, as a
 * command, so status changes don't need a hand-written tinker one-liner.
 *
 * Interactive when given no status; pass `--to` (with any number of ids) to skip
 * the prompt. Examples:
 *   php artisan track:move 285 --to=done
 *   php artisan track:move 285 286 --to=done
 *   php artisan track:move 240 --to=in-progress
 *   php artisan track:move 285 --to=done --note="Shipped in PR #167"
 *   php artisan track:move 285            # prompts for the status
 */
class TrackMove extends Command
{
    // `id` is a trailing array, so the status cannot be a positional argument
    // after it — Symfony forbids a required argument following an array one.
    // It comes in through `--to`, or the interactive prompt when omitted.
    protected $signature = 'track:move
        {id* : One or more tracked item ids}
        {--to= : planned|in-progress|available|done|deferred}
        {--note= : A line appended to each item description, dated}';

    protected $description = 'Move tracked item(s) to a new status on the admin tracker';

    public function handle(): int
    {
        /** @var array<int, string> $ids */
        $ids = $this->argument('id');

        $status = $this->option('to');

        if ($status === null || $status === '') {
            $status = select('Move to', Item::STATUSES);
        }

        if (! array_key_exists($status, Item::STATUSES)) {
            $this->error("Invalid status: {$status}. One of: ".implode(', ', array_keys(Item::STATUSES)));

            return self::FAILURE;
        }

        $note = $this->option('note');

        $items = Item::findMany($ids);
        $missing = array_diff(
            array_map('intval', $ids),
            $items->pluck('id')->all(),
        );

        foreach ($missing as $id) {
            $this->warn("No tracked item #{$id}.");
        }

        if ($items->isEmpty()) {
            $this->error('Nothing to move.');

            return self::FAILURE;
        }

        foreach ($items as $item) {
            $from = $item->status;

            // A no-op move is worth saying, not silently counting as a change —
            // and it must not stamp a fresh activity date for a status that did
            // not actually move.
            if ($from === $status) {
                $this->line("#{$item->id} already {$status} — {$item->title}");

                continue;
            }

            $item->status = $status;

            if ($note !== null && $note !== '') {
                $item->description = trim(($item->description ?? '')."\n\n".now()->toDateString().": {$note}");
            }

            $item->save();

            $this->info("#{$item->id}  {$from} → {$status}  — {$item->title}");
        }

        return self::SUCCESS;
    }
}
