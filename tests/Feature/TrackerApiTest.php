<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

/**
 * The tracker API (W-33).
 *
 * This exists because two copies of the tracker drifted apart: work was logged
 * to a local SQLite file while the board the owner reads sat on a droplet,
 * with nothing syncing them and nothing saying so. The server is now the one
 * that counts, which makes these tests about trust — who can write, and
 * whether an id still means what a changelog says it means.
 */
class TrackerApiTest extends TestCase
{
    use RefreshDatabase;

    private const TOKEN = 'test-token-value';

    protected function setUp(): void
    {
        parent::setUp();

        config(['tracker.token' => self::TOKEN]);
    }

    /** @param array<string, mixed> $payload */
    private function sendPost(string $path, array $payload = [], ?string $token = self::TOKEN): TestResponse
    {
        return $this->withToken((string) $token)->postJson($path, $payload);
    }

    public function test_a_write_needs_a_token(): void
    {
        $this->postJson('/api/tracker/items', ['title' => 'No token'])
            ->assertUnauthorized();

        $this->assertSame(0, Item::count());
    }

    public function test_a_wrong_token_is_refused(): void
    {
        $this->sendPost('/api/tracker/items', ['title' => 'Bad token'], 'not-the-token')
            ->assertUnauthorized();
    }

    /**
     * An API that accepts writes because nobody set a token would be worse
     * than no API: the failure is silent and the damage is in the database.
     */
    public function test_an_unconfigured_server_refuses_everything(): void
    {
        config(['tracker.token' => null]);

        $this->sendPost('/api/tracker/items', ['title' => 'Unconfigured'])
            ->assertStatus(503);
    }

    public function test_it_creates_an_item(): void
    {
        $response = $this->sendPost('/api/tracker/items', [
            'title' => 'A new thing',
            'platform' => 'web',
            'type' => 'feature',
            'status' => 'planned',
            'priority' => 'high',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('title', 'A new thing');

        $this->assertSame(1, Item::count());
        $this->assertSame('high', Item::first()->priority);
    }

    public function test_it_validates_the_enums(): void
    {
        $this->sendPost('/api/tracker/items', [
            'title' => 'Bad platform',
            'platform' => 'not-a-platform',
            'type' => 'feature',
            'status' => 'planned',
            'priority' => 'high',
        ])->assertStatus(422);

        // The repo column stayed unvalidated for a while and a typo simply
        // stored a value nothing read back, so the item belonged to no repo.
        $this->sendPost('/api/tracker/items', [
            'title' => 'Bad repo',
            'platform' => 'web',
            'type' => 'feature',
            'status' => 'planned',
            'priority' => 'high',
            'repo' => 'NotARepo',
        ])->assertStatus(422);
    }

    public function test_it_moves_an_item_between_statuses(): void
    {
        $item = Item::create([
            'title' => 'Move me', 'platform' => 'web', 'type' => 'todo',
            'status' => 'planned', 'priority' => 'normal',
        ]);

        $this->withToken(self::TOKEN)
            ->patchJson("/api/tracker/items/{$item->id}", ['status' => 'done'])
            ->assertOk()
            ->assertJsonPath('status', 'done');

        $this->assertSame('done', $item->fresh()->status);
    }

    public function test_updating_an_unknown_item_is_a_404(): void
    {
        $this->withToken(self::TOKEN)
            ->patchJson('/api/tracker/items/999999', ['status' => 'done'])
            ->assertNotFound();
    }

    public function test_it_lists_open_items(): void
    {
        foreach (['planned', 'in-progress', 'done', 'deferred'] as $status) {
            Item::create([
                'title' => "A {$status} item", 'platform' => 'web',
                'type' => 'todo', 'status' => $status, 'priority' => 'normal',
            ]);
        }

        $response = $this->withToken(self::TOKEN)->getJson('/api/tracker/items?open=1');

        $response->assertOk();

        // planned + in-progress, not done or deferred.
        $this->assertSame(2, $response->json('count'));
    }

    /**
     * The reconciliation case, and the reason it exists at all.
     *
     * Changelogs, commit messages and issue descriptions across three
     * repositories refer to items by number — "S-396", "W-32". Renumbering on
     * import would break every one of those references without a single error.
     */
    public function test_import_preserves_ids(): void
    {
        $this->sendPost('/api/tracker/import', [
            'items' => [
                ['id' => 396, 'title' => 'Hide unresolved items', 'platform' => 'server-desktop',
                    'type' => 'feature', 'status' => 'done', 'priority' => 'high'],
                ['id' => 402, 'title' => 'Desktop versioning', 'platform' => 'server-desktop',
                    'type' => 'feature', 'status' => 'done', 'priority' => 'high'],
            ],
        ])->assertOk()->assertJsonPath('created', 2);

        $this->assertSame('Hide unresolved items', Item::find(396)->title);
        $this->assertSame('Desktop versioning', Item::find(402)->title);
    }

    public function test_import_updates_rather_than_duplicating(): void
    {
        // Run twice: reconciling two databases is the kind of thing someone
        // repeats when they are not sure the first one worked.
        $payload = ['items' => [[
            'id' => 100, 'title' => 'First version', 'platform' => 'web',
            'type' => 'todo', 'status' => 'planned', 'priority' => 'normal',
        ]]];

        $this->sendPost('/api/tracker/import', $payload)->assertOk();

        $payload['items'][0]['title'] = 'Second version';
        $payload['items'][0]['status'] = 'done';

        $this->sendPost('/api/tracker/import', $payload)
            ->assertOk()
            ->assertJsonPath('created', 0)
            ->assertJsonPath('updated', 1);

        $this->assertSame(1, Item::count());
        $this->assertSame('Second version', Item::find(100)->title);
        $this->assertSame('done', Item::find(100)->status);
    }
}
