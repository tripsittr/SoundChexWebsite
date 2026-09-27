<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Reading and writing the tracker over HTTP (W-33).
 *
 * The tracker is the one record of what every SoundChex repo is doing, and it
 * lives in one SQLite file on one droplet. Work was being logged to a *local*
 * copy of that file, so the board the owner actually opens fell behind by a
 * dozen items and a session's worth of status changes. This is the fix: the
 * server owns the data, and the CLI on any machine writes here.
 *
 * Token-authed (see `TrackerToken`), because a tracker that anyone can write
 * to is a tracker nobody can trust.
 */
class TrackerController extends Controller
{
    /**
     * Items, newest first, optionally filtered.
     *
     * Exists so the CLI can show a board without a second source of truth, and
     * so `track:move` can report what it is about to change.
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->validate([
            'status' => ['nullable', Rule::in(array_keys(Item::STATUSES))],
            'platform' => ['nullable', Rule::in(array_keys(Item::PLATFORMS))],
            'open' => ['nullable', 'boolean'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:500'],
        ]);

        $query = Item::query()->orderByDesc('id');

        if (filled($data['status'] ?? null)) {
            $query->where('status', $data['status']);
        }

        if (filled($data['platform'] ?? null)) {
            $query->where('platform', $data['platform']);
        }

        // "Open" is the question actually asked of a tracker — what is left —
        // and it spans three statuses, so the API answers it directly rather
        // than making every caller remember which three.
        if ($request->boolean('open')) {
            $query->whereIn('status', ['planned', 'in-progress', 'available']);
        }

        $items = $query->limit($data['limit'] ?? 100)->get();

        return response()->json([
            'count' => $items->count(),
            'items' => $items->map(fn (Item $item): array => $this->payload($item)),
        ]);
    }

    /** Adds an item. Mirrors `track:issue`. */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'platform' => ['required', Rule::in(array_keys(Item::PLATFORMS))],
            'type' => ['required', Rule::in(array_keys(Item::TYPES))],
            'status' => ['required', Rule::in(array_keys(Item::STATUSES))],
            'priority' => ['required', Rule::in(array_keys(Item::PRIORITIES))],
            // Nullable but validated when present: an unchecked repo used to
            // store a typo that nothing ever read back, so the item quietly
            // belonged to no repository.
            'repo' => ['nullable', Rule::in(array_keys(Item::REPOS))],
            'description' => ['nullable', 'string'],
            'ref' => ['nullable', 'string', 'max:64'],
            'public_summary' => ['nullable', 'string'],
            'published' => ['nullable', 'boolean'],
        ]);

        $item = Item::create([
            ...$data,
            'published' => $data['published'] ?? false,
            'sort_order' => (int) Item::where('platform', $data['platform'])->max('sort_order') + 1,
        ]);

        return response()->json($this->payload($item), 201);
    }

    /**
     * Changes an item — status, priority, description, anything.
     *
     * A PATCH rather than a PUT: the common call is moving one card between
     * columns, and making the caller send the whole item to do that invites
     * it to send a stale copy of every other field.
     */
    public function update(Request $request, int $item): JsonResponse
    {
        $record = Item::find($item);

        if ($record === null) {
            return response()->json(['message' => "No tracker item #{$item}."], 404);
        }

        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'platform' => ['sometimes', Rule::in(array_keys(Item::PLATFORMS))],
            'type' => ['sometimes', Rule::in(array_keys(Item::TYPES))],
            'status' => ['sometimes', Rule::in(array_keys(Item::STATUSES))],
            'priority' => ['sometimes', Rule::in(array_keys(Item::PRIORITIES))],
            'repo' => ['sometimes', 'nullable', Rule::in(array_keys(Item::REPOS))],
            'description' => ['sometimes', 'nullable', 'string'],
            'ref' => ['sometimes', 'nullable', 'string', 'max:64'],
            'public_summary' => ['sometimes', 'nullable', 'string'],
            'published' => ['sometimes', 'boolean'],
        ]);

        if ($data === []) {
            return response()->json(['message' => 'Nothing to change.'], 422);
        }

        $record->update($data);

        return response()->json($this->payload($record->fresh()));
    }

    /**
     * Imports items keeping their ids (W-33).
     *
     * For reconciling the two databases that drifted apart. Ids are preserved
     * rather than reassigned because changelogs, commit messages and issue
     * descriptions across three repositories refer to items by number — "S-396",
     * "W-32" — and renumbering would break every one of those references
     * silently.
     *
     * Upserts: an id already present is updated, a new one is inserted. So it
     * can be run twice without doubling the tracker.
     */
    public function import(Request $request): JsonResponse
    {
        $data = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'min:1'],
            'items.*.title' => ['required', 'string', 'max:255'],
            'items.*.platform' => ['required', Rule::in(array_keys(Item::PLATFORMS))],
            'items.*.type' => ['required', Rule::in(array_keys(Item::TYPES))],
            'items.*.status' => ['required', Rule::in(array_keys(Item::STATUSES))],
            'items.*.priority' => ['required', Rule::in(array_keys(Item::PRIORITIES))],
        ]);

        $created = 0;
        $updated = 0;

        foreach ($data['items'] as $row) {
            $existing = Item::find($row['id']);

            if ($existing === null) {
                $item = new Item;
                $item->id = $row['id'];
                $created++;
            } else {
                $item = $existing;
                $updated++;
            }

            $item->fill(collect($row)->except('id')->all());
            $item->save();
        }

        return response()->json([
            'created' => $created,
            'updated' => $updated,
            'total' => Item::count(),
        ]);
    }

    /** @return array<string, mixed> */
    private function payload(Item $item): array
    {
        return $item->only([
            'id', 'title', 'description', 'platform', 'repo', 'type', 'status',
            'priority', 'published', 'ref', 'public_summary', 'sort_order',
            'created_at', 'updated_at',
        ]);
    }
}
