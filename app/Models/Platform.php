<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A platform in the home "Runs where you do" grid.
 */
class Platform extends Model
{
    protected $fillable = ['name', 'available', 'sort_order'];

    protected function casts(): array
    {
        return [
            'available' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /** In display order, for the home grid. */
    public static function ordered()
    {
        return static::orderBy('sort_order')->orderBy('id')->get();
    }
}
