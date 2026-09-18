<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A public changelog entry, shown on /changelog.
 */
class ReleaseNote extends Model
{
    protected $fillable = [
        'version', 'title', 'platform', 'body', 'released_on', 'published', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'released_on' => 'date',
            'published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /** Published notes, newest first (by date, then sort_order). */
    public static function published()
    {
        return static::query()
            ->where('published', true)
            ->orderByDesc('released_on')
            ->orderByDesc('sort_order')
            ->orderByDesc('id')
            ->get();
    }
}
