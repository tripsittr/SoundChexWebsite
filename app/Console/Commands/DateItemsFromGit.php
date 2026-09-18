<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

/**
 * Backfills each item's `activity_on` from git history.
 *
 * The imported backlog all has `created_at`/`updated_at` of "seeded today",
 * which is useless as a freshness signal on the roadmap. The real date an item
 * was worked on is when its ref (S-52, W-12, IOS-08) first appeared in a repo —
 * so this git-log-searches for the ref across the app and website repos and
 * takes the earliest commit date.
 */
class DateItemsFromGit extends Command
{
    protected $signature = 'items:date-from-git {--dry-run : Show what would change without saving}';

    protected $description = "Backfill items' activity_on from when their ref first appeared in git";

    /**
     * Repos to search, newest-relevant first. Paths are relative to this
     * (website) repo. The app repo is a sibling.
     *
     * @var array<int, string>
     */
    protected array $repos = [
        '.',            // the website repo (W-NN)
        '../SoundChex App', // the app repo (S-NN, IOS-NN)
    ];

    public function handle(): int
    {
        $items = Item::whereNotNull('ref')->get();
        $this->info("Dating {$items->count()} items from git history…");

        $dated = 0;
        $missed = 0;

        foreach ($items as $item) {
            $date = $this->firstSeen($item->ref);

            if ($date === null) {
                $missed++;

                continue;
            }

            $this->line("  {$item->ref} → {$date}");

            if (! $this->option('dry-run')) {
                $item->activity_on = $date;
                $item->saveQuietly(); // don't bump updated_at
            }
            $dated++;
        }

        $this->newLine();
        $this->info("Dated {$dated} items; {$missed} had no git trace (left null).");

        return self::SUCCESS;
    }

    /**
     * The earliest commit date any repo shows the ref, as YYYY-MM-DD, or null.
     */
    protected function firstSeen(string $ref): ?string
    {
        $dates = [];

        foreach ($this->repos as $repo) {
            $path = base_path($repo);
            if (! is_dir($path.'/.git') && ! is_dir($path.'/../.git')) {
                // A sibling repo may not be a checkout in every environment.
                if (! is_dir($path)) {
                    continue;
                }
            }

            // -S finds commits that add/remove the literal ref; --diff-filter
            // is not used so both additions and the surrounding history count.
            // The last line of `git log` (oldest) is the first appearance.
            $result = Process::path($path)->run([
                'git', 'log', '--format=%ad', '--date=short', '-S', $ref, '--', '.',
            ]);

            if (! $result->successful()) {
                continue;
            }

            $lines = array_values(array_filter(
                explode("\n", trim($result->output())),
                fn (string $l) => $l !== '',
            ));

            if ($lines !== []) {
                $dates[] = end($lines); // oldest
            }
        }

        if ($dates === []) {
            return null;
        }

        sort($dates); // earliest first

        return $dates[0];
    }
}
