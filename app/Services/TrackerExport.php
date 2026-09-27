<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Services;

use App\Models\Item;

/**
 * The tracker as a portable snapshot (W-32).
 *
 * The items are the one thing here that exists nowhere else — the code is on
 * GitHub and the site can be rebuilt from it, but a roadmap written over
 * months cannot. On a single server that database file is a single point of
 * failure.
 *
 * Items only. The admin user is one row that takes seconds to recreate, and
 * sessions and caches are noise; including them would turn a restore into a
 * decision about whose login wins.
 */
class TrackerExport
{
    /** Bumped when the shape changes, so a restore can tell what it is reading. */
    public const VERSION = 1;

    /**
     * Every item, oldest first, ready to encode.
     *
     * Ordered by id rather than status or date: a diff between two exports
     * should show what changed, not what moved in a sort.
     *
     * @return array{version: int, exported_at: string, count: int, items: array<int, array<string, mixed>>}
     */
    public function toArray(): array
    {
        $items = Item::query()
            ->orderBy('id')
            ->get()
            ->map(fn (Item $item): array => $item->only([
                'id',
                'title',
                'description',
                'platform',
                'repo',
                'type',
                'status',
                'priority',
                'published',
                'ref',
                'public_summary',
                'sort_order',
                'created_at',
                'updated_at',
                'activity_on',
            ]))
            ->all();

        return [
            'version' => self::VERSION,
            'exported_at' => now()->toIso8601String(),
            'count' => count($items),
            'items' => $items,
        ];
    }

    /**
     * The snapshot as pretty JSON.
     *
     * Pretty-printed on purpose: this is meant to be committed and diffed, and
     * a single-line file shows every change as one enormous edit.
     */
    public function toJson(): string
    {
        return json_encode(
            $this->toArray(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
        ).PHP_EOL;
    }

    /** `tracker-2026-09-25.json` — dated, so downloads do not overwrite. */
    public function filename(): string
    {
        return 'tracker-'.now()->format('Y-m-d').'.json';
    }
}
