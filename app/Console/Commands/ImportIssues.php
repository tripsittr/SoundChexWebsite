<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;

/**
 * One-time (re-runnable) import of the Markdown issue trackers from every
 * SoundChex repo into the `items` table, so tracking can move fully into the
 * admin panel and the per-repo `Issues.md` files can be retired.
 *
 * Idempotent: keyed on `ref`, so re-running updates rather than duplicates.
 * Only fills the import fields; anything you later edit in the panel (e.g.
 * `published`, `public_summary`) is preserved on re-import.
 *
 *   php artisan items:import              # import from the sibling repos
 *   php artisan items:import --dry-run    # report only
 */
class ImportIssues extends Command
{
    protected $signature = 'items:import {--dry-run : Parse and report without writing}';

    protected $description = 'Import the repos\' Markdown issue trackers into the items table';

    /**
     * Per-repo source config: file (relative to the repos' parent dir), the id
     * prefix, the repo name, the default platform, and the format.
     *
     * @var array<int, array{file: string, repo: string, platform: string, format: string}>
     */
    private array $sources = [
        ['file' => 'SoundChex App/Documentation & Planning/Issues.md', 'repo' => 'SoundChex', 'platform' => 'server-desktop', 'format' => 'table'],
        ['file' => 'SoundChexiOS/Plans/Issues.md', 'repo' => 'SoundChexiOS', 'platform' => 'ios', 'format' => 'table'],
        ['file' => 'SoundChexAndroid/Documentation & Planning/Issues.md', 'repo' => 'SoundChexAndroid', 'platform' => 'android', 'format' => 'table'],
        ['file' => 'SoundChexTV/Documentation & Planning/Issues.md', 'repo' => 'SoundChexTV', 'platform' => 'tv', 'format' => 'table'],
        ['file' => 'SoundChexRoku/Documentation & Planning/Issues.md', 'repo' => 'SoundChexRoku', 'platform' => 'roku', 'format' => 'table'],
        ['file' => 'SoundChex Website/Documentation & Planning/Issues.md', 'repo' => 'SoundChexWebsite', 'platform' => 'web', 'format' => 'bullet'],
    ];

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');
        // The repos live side by side; this app is …/SoundChex Website/…
        $reposDir = dirname(base_path());

        $total = 0;
        foreach ($this->sources as $src) {
            $path = $reposDir.'/'.$src['file'];
            if (! is_file($path)) {
                $this->warn("skip (not found): {$src['file']}");

                continue;
            }

            $rows = $src['format'] === 'table'
                ? $this->parseTable(file_get_contents($path))
                : $this->parseBullets(file_get_contents($path));

            $count = 0;
            foreach ($rows as $row) {
                $data = [
                    'title' => $row['title'],
                    'description' => $row['notes'],
                    'platform' => $src['platform'],
                    'repo' => $src['repo'],
                    'type' => $this->guessType($row['title'].' '.$row['notes']),
                    'status' => $row['status'],
                    'priority' => 'normal',
                ];

                if (! $dry) {
                    // updateOrCreate on ref; do NOT touch published/public_summary/
                    // sort_order so panel edits survive a re-import.
                    $item = Item::firstOrNew(['ref' => $row['ref']]);
                    $item->fill($data);
                    $item->save();
                }
                $count++;
            }

            $this->line(sprintf('%-18s %3d items  (%s)', $src['repo'], $count, $src['platform']));
            $total += $count;
        }

        $this->info(($dry ? '[dry-run] ' : '').("Imported {$total} items."));

        return self::SUCCESS;
    }

    /**
     * Parse a `| ID | Title | Notes |` tracker, tracking the current section
     * heading (In progress / Open / Deferred / Done) to set status.
     *
     * @return array<int, array{ref: string, title: string, notes: ?string, status: string}>
     */
    private function parseTable(string $text): array
    {
        $status = 'planned';
        $out = [];
        foreach (explode("\n", $text) as $line) {
            if (preg_match('/^##\s+(.+)$/', trim($line), $m)) {
                $status = $this->sectionStatus($m[1]);

                continue;
            }
            // A data row: | ID | title | notes... |  (skip header/separator rows)
            if (! preg_match('/^\|\s*([A-Z]+-[A-Za-z0-9]+)\s*\|(.+)$/', $line, $m)) {
                continue;
            }
            $ref = trim($m[1]);
            $cells = array_map('trim', explode('|', rtrim($m[2], ' |')));
            $title = $cells[0] ?? $ref;
            // Notes may include a "Fixed"/"Verified" column too; join the rest.
            $notes = trim(implode(' — ', array_slice($cells, 1)));
            $out[] = ['ref' => $ref, 'title' => $title, 'notes' => $notes ?: null, 'status' => $status];
        }

        return $out;
    }

    /**
     * Parse a `- **ID — Title.** Notes…` bullet tracker.
     *
     * @return array<int, array{ref: string, title: string, notes: ?string, status: string}>
     */
    private function parseBullets(string $text): array
    {
        $status = 'planned';
        $out = [];
        $lines = explode("\n", $text);
        for ($i = 0; $i < count($lines); $i++) {
            $line = $lines[$i];
            if (preg_match('/^##\s+(.+)$/', trim($line), $m)) {
                $status = $this->sectionStatus($m[1]);

                continue;
            }
            if (! preg_match('/^-\s+\*\*([A-Z]+-[0-9]+)\s+—\s+(.+?)\.\*\*\s*(.*)$/u', $line, $m)) {
                continue;
            }
            $ref = trim($m[1]);
            $title = trim($m[2]);
            $notes = trim($m[3]);
            // Gather continuation lines (indented, until the next bullet/heading).
            while ($i + 1 < count($lines) && preg_match('/^\s+\S/', $lines[$i + 1]) && ! preg_match('/^-\s+\*\*/', trim($lines[$i + 1]))) {
                $notes .= ' '.trim($lines[++$i]);
            }
            $out[] = ['ref' => $ref, 'title' => $title, 'notes' => $notes ?: null, 'status' => $status];
        }

        return $out;
    }

    private function sectionStatus(string $heading): string
    {
        $h = strtolower($heading);

        return match (true) {
            str_contains($h, 'in progress') => 'in-progress',
            str_contains($h, 'deferred') => 'deferred',
            str_contains($h, 'done') => 'done',
            default => 'planned', // "Open" and anything else
        };
    }

    private function guessType(string $text): string
    {
        $t = strtolower($text);

        return match (true) {
            preg_match('/\b(bug|broke|fails?|crash|corrupt|leak|wrong|error|regression)\b/', $t) === 1 => 'bug',
            preg_match('/\b(feature|add|build|support|implement|native app|panel)\b/', $t) === 1 => 'feature',
            default => 'todo',
        };
    }
}
