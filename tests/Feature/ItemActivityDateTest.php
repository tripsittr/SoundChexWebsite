<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * `activity_on` tracks when an item's STATUS last changed — the roadmap's
 * freshness signal. It moves to today on a status change, and only then.
 */
class ItemActivityDateTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_new_item_gets_todays_activity_date(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);

        $this->assertNotNull($item->activity_on);
        $this->assertSame(now()->toDateString(), $item->activity_on->toDateString());
    }

    public function test_changing_status_advances_activity_on(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);
        // Backdate it as if it were an older, git-dated item.
        $item->activity_on = '2026-01-01';
        $item->saveQuietly();

        $item->status = 'in-progress';
        $item->save();

        $this->assertSame(now()->toDateString(), $item->fresh()->activity_on->toDateString());
    }

    public function test_editing_a_non_status_field_does_not_move_activity_on(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);
        $item->activity_on = '2026-01-01';
        $item->saveQuietly();

        // Change only the title — activity_on must not move.
        $item->title = 'a new title';
        $item->save();

        $this->assertSame('2026-01-01', $item->fresh()->activity_on->toDateString());
    }
}
