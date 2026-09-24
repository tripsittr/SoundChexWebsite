<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Pages;

use App\Filament\Resources\Items\Schemas\ItemInfolist;
use App\Models\Item;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

/**
 * A Trello/Jira-style board over the tracker: columns are statuses, cards are
 * items, dragging a card between columns updates its status. Platform, type and
 * ref are shown as badges on each card.
 */
class Board extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    protected static ?string $navigationLabel = 'Board';

    protected static ?string $title = 'Board';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.board';

    /** Optional platform filter (null = all). */
    public ?string $platform = null;

    /** The current column order (status keys), persisted per session. */
    public array $columnOrder = [];

    /** The columns and their labels. Default order; user can drag to reorder. */
    public const COLUMNS = [
        'planned' => 'Planned',
        'in-progress' => 'In progress',
        'available' => 'Shipped',
        'deferred' => 'Deferred',
        'done' => 'Done',
    ];

    public function mount(): void
    {
        $this->columnOrder = $this->normaliseOrder(session('board.column_order', []));
    }

    /** Persist a new column order from the drag handler. */
    public function saveColumnOrder(array $order): void
    {
        $this->columnOrder = $this->normaliseOrder($order);
        session(['board.column_order' => $this->columnOrder]);
    }

    /**
     * Keep only known statuses, then append any missing (e.g. a newly added
     * status), so a stale saved order never hides a column. Duplicates are
     * dropped — a repeated key would render the same column twice.
     *
     * @param  array<int, mixed>  $order
     * @return array<int, string>
     */
    private function normaliseOrder(array $order): array
    {
        $known = array_values(array_unique(array_filter(
            $order,
            fn ($status) => array_key_exists($status, self::COLUMNS),
        )));

        $missing = array_diff(array_keys(self::COLUMNS), $known);

        return array_values([...$known, ...$missing]);
    }

    /** The slide-over "view item" action, opened when a card is clicked. */
    public function viewItemAction(): Action
    {
        return Action::make('viewItem')
            ->modalHeading(fn (array $arguments) => Item::find($arguments['item'])?->title ?? 'Item')
            ->slideOver()
            ->record(fn (array $arguments) => Item::find($arguments['item']))
            ->infolist(fn ($schema) => ItemInfolist::configure($schema))
            ->modalSubmitAction(false)
            ->modalCancelActionLabel('Close');
    }

    /** How many "done" cards to show before a "+N more" note. */
    private const DONE_LIMIT = 15;

    /**
     * Items grouped by status column, honouring the platform filter.
     *
     * @return array<string, array{label: string, items: Collection, extra: int, total: int}>
     */
    public function getColumns(): array
    {
        $base = Item::query()
            ->when($this->platform, fn ($query) => $query->where('platform', $this->platform))
            ->orderBy('sort_order')
            ->orderByDesc('updated_at');

        $order = $this->columnOrder !== [] ? $this->columnOrder : array_keys(self::COLUMNS);

        $columns = [];
        foreach ($order as $status) {
            $query = (clone $base)->where('status', $status);

            // Only "done" is capped, so only it needs the extra count query to
            // work out the "+N more" note; elsewhere the fetched rows are all.
            if ($status === 'done') {
                $total = (clone $query)->count();
                $items = $query->limit(self::DONE_LIMIT)->get();
            } else {
                $items = $query->get();
                $total = $items->count();
            }

            $columns[$status] = [
                'label' => self::COLUMNS[$status] ?? $status,
                'items' => $items,
                'extra' => max(0, $total - $items->count()),
                'total' => $total,
            ];
        }

        return $columns;
    }

    /** Platform options for the filter chips. */
    public function getPlatforms(): array
    {
        return Item::PLATFORMS;
    }

    /**
     * Move a card to a new status column (called from the JS drag handler).
     */
    public function moveCard(int $itemId, string $status): void
    {
        if (! array_key_exists($status, self::COLUMNS)) {
            return;
        }

        $item = Item::find($itemId);
        if ($item && $item->status !== $status) {
            $item->update(['status' => $status]);
        }
    }

    public function setPlatform(?string $platform): void
    {
        $this->platform = $platform ?: null;
    }
}
