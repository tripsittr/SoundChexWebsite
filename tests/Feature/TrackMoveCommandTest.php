<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * `track:move` is the Board's drag as a command — the supported way to change an
 * item's status from the console, replacing hand-written tinker updates.
 */
class TrackMoveCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_moves_an_item_to_a_new_status(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);

        $this->artisan('track:move', ['id' => [$item->id], '--to' => 'done'])
            ->assertSuccessful();

        $this->assertSame('done', $item->fresh()->status);
    }

    public function test_it_prompts_for_the_status_when_none_is_given(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);

        $this->artisan('track:move', ['id' => [$item->id]])
            ->expectsQuestion('Move to', 'in-progress')
            ->assertSuccessful();

        $this->assertSame('in-progress', $item->fresh()->status);
    }

    public function test_it_moves_several_items_at_once(): void
    {
        $a = Item::create(['title' => 'a', 'status' => 'planned', 'platform' => 'ios']);
        $b = Item::create(['title' => 'b', 'status' => 'in-progress', 'platform' => 'ios']);

        $this->artisan('track:move', ['id' => [$a->id, $b->id], '--to' => 'done'])
            ->assertSuccessful();

        $this->assertSame('done', $a->fresh()->status);
        $this->assertSame('done', $b->fresh()->status);
    }

    public function test_it_rejects_an_invalid_status(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);

        $this->artisan('track:move', ['id' => [$item->id], '--to' => 'shipped-ish'])
            ->assertFailed();

        $this->assertSame('planned', $item->fresh()->status);
    }

    public function test_a_missing_id_is_reported_but_others_still_move(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);

        $this->artisan('track:move', ['id' => [$item->id, 999999], '--to' => 'done'])
            ->expectsOutputToContain('No tracked item #999999.')
            ->assertSuccessful();

        $this->assertSame('done', $item->fresh()->status);
    }

    public function test_moving_the_status_advances_the_activity_date(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios']);
        $item->activity_on = '2026-01-01';
        $item->saveQuietly();

        $this->artisan('track:move', ['id' => [$item->id], '--to' => 'done'])
            ->assertSuccessful();

        $this->assertSame(now()->toDateString(), $item->fresh()->activity_on->toDateString());
    }

    public function test_a_no_op_move_does_not_advance_the_activity_date(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'done', 'platform' => 'ios']);
        $item->activity_on = '2026-01-01';
        $item->saveQuietly();

        $this->artisan('track:move', ['id' => [$item->id], '--to' => 'done'])
            ->expectsOutputToContain('already done')
            ->assertSuccessful();

        $this->assertSame('2026-01-01', $item->fresh()->activity_on->toDateString());
    }

    /**
     * "Already there" and "no such item" are different answers.
     *
     * Routing track:move through the API client (W-33) briefly made a no-op
     * move exit non-zero, which would have broken any script that moves a
     * batch where some items are already done.
     */
    public function test_an_unknown_id_fails_but_an_already_moved_item_does_not(): void
    {
        $this->artisan('track:move', ['id' => [999999], '--to' => 'done'])
            ->assertFailed();

        $item = Item::create(['title' => 'x', 'status' => 'done', 'platform' => 'ios']);

        $this->artisan('track:move', ['id' => [$item->id], '--to' => 'done'])
            ->assertSuccessful();
    }

    public function test_a_note_is_appended_and_dated(): void
    {
        $item = Item::create(['title' => 'x', 'status' => 'planned', 'platform' => 'ios', 'description' => 'Original.']);

        $this->artisan('track:move', ['id' => [$item->id], '--to' => 'done', '--note' => 'Shipped in PR #167'])
            ->assertSuccessful();

        $description = $item->fresh()->description;
        $this->assertStringContainsString('Original.', $description);
        $this->assertStringContainsString(now()->toDateString().': Shipped in PR #167', $description);
    }
}
