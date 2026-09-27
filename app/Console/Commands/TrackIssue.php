<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Console\Commands;

use App\Models\Item;
use App\Services\TrackerClient;
use Illuminate\Console\Command;
use RuntimeException;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

/**
 * Add a tracked item (todo / issue / roadmap entry) from the console.
 *
 * Interactive by default; pass options to skip the prompts. Examples:
 *   php artisan track:issue
 *   php artisan track:issue "Fix the DMG build" --platform=server-desktop --type=bug
 *   php artisan track:issue "CarPlay" --platform=ios --repo=SoundChexiOS --status=planned --publish
 */
class TrackIssue extends Command
{
    protected $signature = 'track:issue
        {title? : The item title}
        {--platform= : server-desktop|ios|android|tv|roku|web|scnet|integrations|meta}
        {--repo= : SoundChex|SoundChexiOS|SoundChexAndroid|SoundChexTV|SoundChexRoku|SoundChexWebsite}
        {--type=todo : feature|bug|todo|chore}
        {--status=planned : planned|in-progress|available|done|deferred}
        {--priority=normal : low|normal|high|critical}
        {--ref= : Original tracker id, e.g. S-151, IOS-21, W-29}
        {--description= : Longer detail}
        {--summary= : Public roadmap blurb}
        {--publish : Show on the public roadmap immediately}';

    protected $description = 'Add a tracked item (todo / issue / roadmap entry) to the admin tracker';

    public function handle(): int
    {
        $interactive = ! $this->argument('title')
            && ! $this->option('platform');

        $title = $this->argument('title')
            ?: text('Title', required: true);

        // `resolve` reports the bad value itself and returns null, which is also
        // what an unanswered optional prompt gives — so each one is checked here.
        $platform = $this->resolve('platform', Item::PLATFORMS, $interactive, 'Platform');
        $type = $this->resolve('type', Item::TYPES, $interactive, 'Type', 'todo');
        $status = $this->resolve('status', Item::STATUSES, $interactive, 'Status', 'planned');
        $priority = $this->resolve('priority', Item::PRIORITIES, $interactive, 'Priority', 'normal');

        if ($platform === null || $type === null || $status === null || $priority === null) {
            return self::FAILURE;
        }

        $repo = $this->option('repo');
        if ($interactive && ! $repo) {
            $repo = select(
                'Repo (optional)',
                ['' => '— none —'] + Item::REPOS,
                default: '',
            ) ?: null;
        }

        // Validated like every other enum flag. `repo` stayed unchecked for a
        // while and a typo simply stored a bad value — nothing reads it back
        // against the list, so the item just quietly belonged to no repo.
        // Empty stays allowed: the column is nullable and a cross-cutting item
        // genuinely has no single repo.
        if ($repo !== null && $repo !== '' && ! array_key_exists($repo, Item::REPOS)) {
            $this->error("Invalid repo: {$repo}. One of: ".implode(', ', array_keys(Item::REPOS)));

            return self::FAILURE;
        }

        $description = $this->option('description')
            ?: ($interactive ? text('Description (optional)') : null);

        $ref = $this->option('ref')
            ?: ($interactive ? text('Reference id (optional)') : null);

        $publish = $this->option('publish')
            || ($interactive && confirm('Publish to the public roadmap now?', default: false));

        $summary = $this->option('summary')
            ?: ($publish && $interactive ? text('Public roadmap blurb (optional)') : null);

        $client = TrackerClient::fromConfig();

        try {
            $item = $client->create([
                'title' => $title,
                'description' => $description ?: null,
                'platform' => $platform,
                'repo' => $repo ?: null,
                'type' => $type,
                'status' => $status,
                'priority' => $priority,
                'ref' => $ref ?: null,
                'public_summary' => $summary ?: null,
                'published' => $publish,
            ]);
        } catch (RuntimeException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info("Tracked #{$item['id']}: {$item['title']}");
        $this->line('  '.Item::PLATFORMS[$item['platform']]." · {$item['type']} · {$item['status']}".
            ($item['ref'] ? " · {$item['ref']}" : '').
            ($item['published'] ? ' · on roadmap' : ' · internal'));

        // Always said, never inferred. The local and live trackers drifted
        // apart precisely because nothing announced which one was being
        // written to (W-33).
        $this->line("  <fg=gray>→ {$client->target()}</>");

        return self::SUCCESS;
    }

    /**
     * Resolve an enum-ish field from an option, or prompt for it interactively,
     * validating against the allowed set.
     *
     * @param  array<string, string>  $set
     */
    private function resolve(string $option, array $set, bool $interactive, string $label, ?string $default = null): ?string
    {
        $value = $this->option($option);

        if ($value) {
            if (! array_key_exists($value, $set)) {
                $this->error("Invalid {$option}: {$value}. One of: ".implode(', ', array_keys($set)));

                return null;
            }

            return $value;
        }

        if ($interactive) {
            return select($label, $set, default: $default);
        }

        return $default; // non-interactive with no flag → the documented default
    }
}
