<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Tests\Feature;

use App\Filament\Pages\Board;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * The Board's columns are drag-reorderable and the order is remembered per
 * session. A saved order must survive round-tripping without ever losing a
 * column (a status added later) or showing one twice.
 */
class BoardColumnOrderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_it_defaults_to_the_declared_column_order(): void
    {
        Livewire::test(Board::class)
            ->assertSet('columnOrder', array_keys(Board::COLUMNS));
    }

    public function test_a_saved_order_is_kept_and_persisted(): void
    {
        $order = ['done', 'in-progress', 'planned', 'available', 'deferred'];

        Livewire::test(Board::class)
            ->call('saveColumnOrder', $order)
            ->assertSet('columnOrder', $order);

        $this->assertSame($order, session('board.column_order'));
    }

    public function test_unknown_statuses_are_dropped_and_missing_ones_appended(): void
    {
        Livewire::test(Board::class)
            ->call('saveColumnOrder', ['done', 'not-a-status', 'planned'])
            ->assertSet('columnOrder', ['done', 'planned', 'in-progress', 'available', 'deferred']);
    }

    public function test_a_duplicated_column_is_only_shown_once(): void
    {
        Livewire::test(Board::class)
            ->call('saveColumnOrder', ['done', 'done', 'planned'])
            ->assertSet('columnOrder', ['done', 'planned', 'in-progress', 'available', 'deferred']);
    }

    public function test_every_column_is_always_present(): void
    {
        $component = Livewire::test(Board::class)->call('saveColumnOrder', ['available']);

        $order = $component->get('columnOrder');

        $this->assertEqualsCanonicalizing(array_keys(Board::COLUMNS), $order);
        $this->assertSame('available', $order[0]);
    }

    public function test_columns_carry_their_items_and_totals(): void
    {
        Item::create(['title' => 'a', 'status' => 'planned', 'platform' => 'ios']);
        Item::create(['title' => 'b', 'status' => 'planned', 'platform' => 'web']);
        Item::create(['title' => 'c', 'status' => 'done', 'platform' => 'ios']);

        $columns = Livewire::test(Board::class)->instance()->getColumns();

        $this->assertSame(2, $columns['planned']['total']);
        $this->assertCount(2, $columns['planned']['items']);
        $this->assertSame(0, $columns['planned']['extra']);
        $this->assertSame(1, $columns['done']['total']);
    }

    public function test_the_platform_filter_narrows_every_column(): void
    {
        Item::create(['title' => 'a', 'status' => 'planned', 'platform' => 'ios']);
        Item::create(['title' => 'b', 'status' => 'planned', 'platform' => 'web']);

        $board = Livewire::test(Board::class)->call('setPlatform', 'ios')->instance();

        $this->assertSame(1, $board->getColumns()['planned']['total']);
    }
}
