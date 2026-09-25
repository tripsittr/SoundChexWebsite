<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Services;

use App\Models\Item;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Where `track:issue` and `track:move` write (W-33).
 *
 * The tracker is one SQLite file on one droplet, and work was being logged
 * into a *local* copy of it. Nothing synced the two, so the board the owner
 * opens fell a session's worth of work behind without anything looking wrong.
 *
 * With `TRACKER_REMOTE_URL` and `TRACKER_REMOTE_TOKEN` set, the commands write
 * to the live site. Without them they write locally — correct for a fresh
 * clone, and the reason every command now says which database it wrote to
 * rather than leaving it to be assumed.
 */
class TrackerClient
{
    public function __construct(
        private readonly ?string $url = null,
        private readonly ?string $token = null,
    ) {}

    public static function fromConfig(): self
    {
        return new self(
            config('tracker.remote.url'),
            config('tracker.remote.token'),
        );
    }

    /** Whether this machine is configured to write to a live tracker. */
    public function isRemote(): bool
    {
        return filled($this->url) && filled($this->token);
    }

    /** Where writes are going, for the commands to report. */
    public function target(): string
    {
        return $this->isRemote()
            ? (string) $this->url
            : 'the local database on this machine';
    }

    /**
     * Creates an item, remotely or locally.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed> the stored item
     */
    public function create(array $attributes): array
    {
        if (! $this->isRemote()) {
            return $this->localCreate($attributes);
        }

        return $this->send('post', '/api/tracker/items', $attributes);
    }

    /**
     * Changes an item.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed> the stored item
     */
    public function update(int $id, array $attributes): array
    {
        if (! $this->isRemote()) {
            return $this->localUpdate($id, $attributes);
        }

        return $this->send('patch', "/api/tracker/items/{$id}", $attributes);
    }

    /**
     * Pushes items to the live tracker, ids intact.
     *
     * The reconciliation path for two databases that drifted (W-33), and the
     * restore path for a `track:export` snapshot. Chunked because a tracker of
     * a few hundred items in one request is a large body and a slow round
     * trip, and a partial success is easier to reason about in hundreds.
     *
     * @param  array<int, array<string, mixed>>  $items
     * @return array{created: int, updated: int, total: int}
     */
    public function import(array $items, int $chunk = 100): array
    {
        if (! $this->isRemote()) {
            throw new RuntimeException(
                'No remote tracker configured — set TRACKER_REMOTE_URL and TRACKER_REMOTE_TOKEN.',
            );
        }

        $created = 0;
        $updated = 0;
        $total = 0;

        foreach (array_chunk($items, $chunk) as $batch) {
            $result = $this->send('post', '/api/tracker/import', ['items' => $batch]);

            $created += (int) ($result['created'] ?? 0);
            $updated += (int) ($result['updated'] ?? 0);
            $total = (int) ($result['total'] ?? $total);
        }

        return ['created' => $created, 'updated' => $updated, 'total' => $total];
    }

    /**
     * One item, or null when there is no such id.
     *
     * `track:move` needs the current status before it writes, so it can report
     * "planned → done" and skip a move that would change nothing.
     *
     * @return array<string, mixed>|null
     */
    public function find(int $id): ?array
    {
        if (! $this->isRemote()) {
            return Item::find($id)?->toArray();
        }

        try {
            // No single-item GET on the API: the list endpoint already filters,
            // and one more route for one more shape is a route to keep in step
            // for no gain at this size.
            $items = $this->send('get', '/api/tracker/items', ['limit' => 500])['items'] ?? [];
        } catch (RuntimeException) {
            return null;
        }

        foreach ($items as $item) {
            if ((int) ($item['id'] ?? 0) === $id) {
                return $item;
            }
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    private function send(string $method, string $path, array $payload): array
    {
        try {
            $response = Http::withToken((string) $this->token)
                ->acceptJson()
                // Short: this runs in front of someone at a prompt, and a
                // tracker write that hangs for thirty seconds trains people
                // to stop logging things.
                ->timeout(15)
                ->{$method}(rtrim((string) $this->url, '/').$path, $payload);
        } catch (ConnectionException $e) {
            throw new RuntimeException(
                "Could not reach the tracker at {$this->url}: {$e->getMessage()}",
                previous: $e,
            );
        }

        if ($response->failed()) {
            // The validation detail matters more than the status: "platform is
            // invalid" is actionable, "422" is not.
            $detail = $response->json('message')
                ?? $response->json('errors')
                ?? $response->body();

            throw new RuntimeException(
                "Tracker refused the write ({$response->status()}): ".
                (is_array($detail) ? json_encode($detail) : (string) $detail),
            );
        }

        return (array) $response->json();
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    private function localCreate(array $attributes): array
    {
        $item = Item::create([
            ...$attributes,
            'sort_order' => (int) Item::where('platform', $attributes['platform'] ?? null)->max('sort_order') + 1,
        ]);

        return $item->toArray();
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    private function localUpdate(int $id, array $attributes): array
    {
        $item = Item::find($id);

        if ($item === null) {
            throw new RuntimeException("No tracker item #{$id}.");
        }

        $item->update($attributes);

        return $item->fresh()->toArray();
    }
}
