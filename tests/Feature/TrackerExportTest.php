<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Tests\Feature;

use App\Filament\Pages\Board;
use App\Models\Item;
use App\Models\User;
use App\Services\TrackerExport;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Backing up the tracker (W-32).
 *
 * The items are the one thing on this server that exists nowhere else, so the
 * export has to be trustworthy: complete, restorable, and never the thing
 * that fills the disk.
 */
class TrackerExportTest extends TestCase
{
    use RefreshDatabase;

    private function item(string $title): Item
    {
        return Item::create([
            'title' => $title,
            'platform' => 'web',
            'type' => 'todo',
            'status' => 'planned',
            'priority' => 'normal',
        ]);
    }

    public function test_it_exports_every_item(): void
    {
        $this->item('One');
        $this->item('Two');

        $export = app(TrackerExport::class)->toArray();

        $this->assertSame(2, $export['count']);
        $this->assertCount(2, $export['items']);
    }

    public function test_it_carries_the_fields_a_restore_needs(): void
    {
        // A backup missing the description is a list of titles, not a backup.
        $this->item('One')->update(['description' => 'The detail that matters']);

        $first = app(TrackerExport::class)->toArray()['items'][0];

        foreach (['id', 'title', 'description', 'platform', 'status', 'priority', 'created_at'] as $key) {
            $this->assertArrayHasKey($key, $first, "{$key} must survive the export.");
        }
    }

    public function test_it_orders_by_id_so_two_exports_diff_cleanly(): void
    {
        $this->item('Later');
        $this->item('Earlier')->update(['status' => 'done']);

        $ids = array_column(app(TrackerExport::class)->toArray()['items'], 'id');

        $sorted = $ids;
        sort($sorted);

        $this->assertSame($sorted, $ids);
    }

    public function test_the_json_is_valid_and_pretty(): void
    {
        $this->item('One');

        $json = app(TrackerExport::class)->toJson();

        $this->assertIsArray(json_decode($json, true));
        // Pretty-printed so a committed snapshot diffs line by line rather
        // than as one enormous edit.
        $this->assertStringContainsString("\n    ", $json);
    }

    public function test_the_command_writes_a_snapshot(): void
    {
        $this->item('One');

        $this->artisan('track:export')->assertSuccessful();

        $this->assertNotEmpty(File::glob(storage_path('backups/tracker-*.json')));
    }

    public function test_the_command_prunes_old_snapshots(): void
    {
        // A snapshot per deploy fills the disk eventually — and a full disk on
        // the server holding the only copy is the failure this prevents.
        File::ensureDirectoryExists(storage_path('backups'));

        foreach (['2026-09-01_120000', '2026-09-02_120000', '2026-09-03_120000'] as $stamp) {
            File::put(storage_path("backups/tracker-{$stamp}.json"), '{}');
        }

        $this->item('One');

        $this->artisan('track:export', ['--keep' => 2])->assertSuccessful();

        $this->assertCount(2, File::glob(storage_path('backups/tracker-*.json')));
    }

    public function test_the_newest_snapshot_survives_pruning(): void
    {
        // Keeping the wrong ones would be worse than keeping none.
        File::ensureDirectoryExists(storage_path('backups'));
        File::put(storage_path('backups/tracker-2020-01-01_000000.json'), '{}');

        $this->item('One');

        $this->artisan('track:export', ['--keep' => 1])->assertSuccessful();

        $kept = File::glob(storage_path('backups/tracker-*.json'));

        $this->assertCount(1, $kept);
        $this->assertStringNotContainsString('2020-01-01', $kept[0]);
    }

    public function test_an_explicit_path_writes_there_instead(): void
    {
        $this->item('One');

        $path = storage_path('app/custom-export.json');

        $this->artisan('track:export', ['--path' => $path])->assertSuccessful();

        $this->assertFileExists($path);
        File::delete($path);
    }

    public function test_the_panel_button_downloads_the_snapshot(): void
    {
        // A copy that never leaves the droplet does not protect against
        // losing the droplet, which is the point of the button.
        $this->item('One');

        $user = User::factory()->create();
        $this->actingAs($user);
        Filament::setCurrentPanel('admin');

        $response = Livewire::test(Board::class)
            ->callAction('exportTracker');

        $response->assertFileDownloaded();
    }

    public function test_pruning_only_touches_its_own_snapshots(): void
    {
        // prune() runs unattended on every deploy. It globs a directory and
        // deletes, so the blast radius is worth pinning: an operator's own
        // file sitting alongside the snapshots must survive.
        $this->item('One');

        $directory = storage_path('backups');
        File::ensureDirectoryExists($directory);

        File::put($directory.'/tracker-2020-01-01_000000.json', '{}');
        File::put($directory.'/keep-me.json', 'operator');
        File::put($directory.'/tracker-notes.txt', 'operator');

        $this->artisan('track:export', ['--keep' => 1])->assertSuccessful();

        $this->assertFileExists($directory.'/keep-me.json');
        $this->assertFileExists($directory.'/tracker-notes.txt');
        $this->assertFileDoesNotExist($directory.'/tracker-2020-01-01_000000.json');
    }

    protected function tearDown(): void
    {
        File::deleteDirectory(storage_path('backups'));

        parent::tearDown();
    }
}
