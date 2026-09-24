<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * `track:issue` is the supported way to add a tracked item from the console.
 * Its enum flags must be validated once, and a bad one must write nothing.
 */
class TrackIssueCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_an_item_from_flags(): void
    {
        $this->artisan('track:issue', [
            'title' => 'Fix the DMG build',
            '--platform' => 'server-desktop',
            '--type' => 'bug',
        ])->assertSuccessful();

        $item = Item::sole();

        $this->assertSame('Fix the DMG build', $item->title);
        $this->assertSame('server-desktop', $item->platform);
        $this->assertSame('bug', $item->type);
        // The documented non-interactive defaults.
        $this->assertSame('planned', $item->status);
        $this->assertSame('normal', $item->priority);
        $this->assertFalse($item->published);
    }

    public function test_an_invalid_type_fails_without_writing(): void
    {
        $this->artisan('track:issue', [
            'title' => 'x',
            '--platform' => 'web',
            '--type' => 'bogus',
        ])->assertFailed();

        $this->assertSame(0, Item::count());
    }

    public function test_an_invalid_status_fails_without_writing(): void
    {
        $this->artisan('track:issue', [
            'title' => 'x',
            '--platform' => 'web',
            '--status' => 'shipped-ish',
        ])->assertFailed();

        $this->assertSame(0, Item::count());
    }

    public function test_an_invalid_platform_fails_without_writing(): void
    {
        $this->artisan('track:issue', [
            'title' => 'x',
            '--platform' => 'nowhere',
        ])->assertFailed();

        $this->assertSame(0, Item::count());
    }

    /**
     * Regression: the bad value used to be reported twice — once by the resolver
     * and again by a second validation pass that saw the resolver's null and
     * printed a bare "Invalid type: " with an empty value.
     */
    public function test_an_invalid_value_is_reported_once_and_never_blank(): void
    {
        $this->artisan('track:issue', [
            'title' => 'x',
            '--platform' => 'web',
            '--type' => 'bogus',
        ])
            ->expectsOutputToContain('Invalid type: bogus.')
            ->doesntExpectOutputToContain('Invalid type: .')
            ->assertFailed();
    }

    public function test_sort_order_increments_within_a_platform(): void
    {
        $this->artisan('track:issue', ['title' => 'a', '--platform' => 'ios'])->assertSuccessful();
        $this->artisan('track:issue', ['title' => 'b', '--platform' => 'ios'])->assertSuccessful();
        // A different platform starts its own run.
        $this->artisan('track:issue', ['title' => 'c', '--platform' => 'web'])->assertSuccessful();

        $this->assertSame(1, Item::where('title', 'a')->sole()->sort_order);
        $this->assertSame(2, Item::where('title', 'b')->sole()->sort_order);
        $this->assertSame(1, Item::where('title', 'c')->sole()->sort_order);
    }
}
