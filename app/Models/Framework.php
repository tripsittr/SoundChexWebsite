<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * A "Built on" marquee tile on the credits page.
 */
class Framework extends Model
{
    protected $fillable = ['name', 'role', 'url', 'color', 'logo_slug', 'mono', 'sort_order'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return ['sort_order' => 'integer'];
    }

    /**
     * In display order, for the credits marquee.
     *
     * @return Collection<int, static>
     */
    public static function ordered(): Collection
    {
        return static::orderBy('sort_order')->orderBy('id')->get();
    }
}
