<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A tracked item: a todo, an issue, or a public roadmap entry — one shape for
 * all three. `published` decides whether it shows on the public /roadmap.
 */
class Item extends Model
{
    protected $fillable = [
        'title', 'description', 'platform', 'repo', 'type', 'status',
        'priority', 'published', 'ref', 'public_summary', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Platforms, in the order the public roadmap presents them. Key = stored
     * value; value = human label.
     */
    public const PLATFORMS = [
        'server-desktop' => 'Server & desktop',
        'ios' => 'iPhone, iPad & Apple TV',
        'android' => 'Android, Android TV & Fire TV',
        'tv' => 'Smart TVs & streaming boxes',
        'roku' => 'Roku',
        'web' => 'Web',
        'scnet' => 'SCNet — the network',
        'integrations' => 'Integrations',
        'meta' => 'Project / meta',
    ];

    public const REPOS = [
        'SoundChex' => 'SoundChex (server + desktop)',
        'SoundChexiOS' => 'SoundChexiOS',
        'SoundChexAndroid' => 'SoundChexAndroid',
        'SoundChexTV' => 'SoundChexTV',
        'SoundChexRoku' => 'SoundChexRoku',
        'SoundChexWebsite' => 'SoundChexWebsite',
    ];

    public const TYPES = [
        'feature' => 'Feature',
        'bug' => 'Bug',
        'todo' => 'To-do',
        'chore' => 'Chore',
    ];

    // Note on `available` vs `done`: "Shipped" is the public-facing complete
    // state (users can use it; it appears on the public roadmap as "Available").
    // "Done" is the internal complete state (a closed ticket, not on the roadmap).
    public const STATUSES = [
        'planned' => 'Planned',
        'in-progress' => 'In progress',
        'available' => 'Shipped',
        'done' => 'Done',
        'deferred' => 'Deferred',
    ];

    public const PRIORITIES = [
        'low' => 'Low',
        'normal' => 'Normal',
        'high' => 'High',
        'critical' => 'Critical',
    ];

    /** The label for this item's platform group. */
    public function platformLabel(): string
    {
        return self::PLATFORMS[$this->platform] ?? $this->platform;
    }

    /** The blurb the public roadmap shows. */
    public function roadmapSummary(): string
    {
        if (filled($this->public_summary)) {
            return $this->public_summary;
        }

        return str($this->description ?? '')->limit(180)->toString();
    }

    /** Published, roadmap-visible items, grouped and ordered for the public page. */
    public static function publishedForRoadmap()
    {
        return static::query()
            ->where('published', true)
            ->whereIn('status', ['planned', 'in-progress', 'available'])
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();
    }
}
