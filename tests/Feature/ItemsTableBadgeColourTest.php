<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Tests\Feature;

use App\Filament\Resources\Items\Pages\ListItems;
use App\Models\Item;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Regression: the Tracker table coloured its badges with `colors()`, whose
 * conditions are matched with `===`. The entry `'success' => ['available',
 * 'done']` therefore never matched, so both Shipped and Done resolved to no
 * colour and fell back to the default `primary` — the red brand accent —
 * instead of green.
 *
 * This drives the real resource table, so it guards the shipped configuration
 * rather than a copy of it.
 */
class ItemsTableBadgeColourTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_no_status_badge_falls_through_to_the_default_accent(): void
    {
        $column = $this->column('status');

        foreach (array_keys(Item::STATUSES) as $status) {
            $this->assertNotNull(
                $column->getColor($status),
                "Status [{$status}] resolves to no colour, so it renders as the default accent.",
            );
        }
    }

    public function test_shipped_and_done_are_green(): void
    {
        $column = $this->column('status');

        $this->assertSame('success', $column->getColor('available'));
        $this->assertSame('success', $column->getColor('done'));
    }

    public function test_the_other_statuses_keep_their_colours(): void
    {
        $column = $this->column('status');

        $this->assertSame('gray', $column->getColor('planned'));
        $this->assertSame('warning', $column->getColor('in-progress'));
        $this->assertSame('danger', $column->getColor('deferred'));
    }

    public function test_no_type_badge_falls_through_to_the_default_accent(): void
    {
        $column = $this->column('type');

        foreach (array_keys(Item::TYPES) as $type) {
            $this->assertNotNull(
                $column->getColor($type),
                "Type [{$type}] resolves to no colour, so it renders as the default accent.",
            );
        }

        $this->assertSame('danger', $column->getColor('bug'));
        $this->assertSame('primary', $column->getColor('feature'));
    }

    /**
     * A column from the live Tracker table, exactly as the panel builds it.
     */
    private function column(string $name): TextColumn
    {
        $column = Livewire::test(ListItems::class)
            ->instance()
            ->getTable()
            ->getColumn($name);

        $this->assertInstanceOf(TextColumn::class, $column);

        return $column;
    }
}
