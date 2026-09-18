<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A "Built on" marquee tile on the credits page.
 */
class Framework extends Model
{
    protected $fillable = ['name', 'role', 'url', 'color', 'logo_slug', 'mono', 'sort_order'];

    protected function casts(): array
    {
        return ['sort_order' => 'integer'];
    }

    public static function ordered()
    {
        return static::orderBy('sort_order')->orderBy('id')->get();
    }
}
