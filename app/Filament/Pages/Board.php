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
        $saved = session('board.column_order', []);
        // Keep only known statuses, then append any missing (e.g. new statuses).
        $order = array_values(array_filter($saved, fn ($s) => array_key_exists($s, self::COLUMNS)));
        foreach (array_keys(self::COLUMNS) as $s) {
            if (! in_array($s, $order, true)) {
                $order[] = $s;
            }
        }
        $this->columnOrder = $order;
    }

    /** Persist a new column order from the drag handler. */
    public function saveColumnOrder(array $order): void
    {
        $order = array_values(array_filter($order, fn ($s) => array_key_exists($s, self::COLUMNS)));
        foreach (array_keys(self::COLUMNS) as $s) {
            if (! in_array($s, $order, true)) {
                $order[] = $s;
            }
        }
        $this->columnOrder = $order;
        session(['board.column_order' => $order]);
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
     * @return array<string, array{label: string, items: Collection, extra: int}>
     */
    public function getColumns(): array
    {
        $base = Item::query()
            ->when($this->platform, fn ($q) => $q->where('platform', $this->platform))
            ->orderBy('sort_order')
            ->orderByDesc('updated_at');

        $order = ! empty($this->columnOrder) ? $this->columnOrder : array_keys(self::COLUMNS);

        $out = [];
        foreach ($order as $status) {
            $label = self::COLUMNS[$status] ?? $status;
            $q = (clone $base)->where('status', $status);
            $total = (clone $q)->count();
            $items = $status === 'done' ? $q->limit(self::DONE_LIMIT)->get() : $q->get();
            $out[$status] = [
                'label' => $label,
                'items' => $items,
                'extra' => max(0, $total - $items->count()),
                'total' => $total,
            ];
        }

        return $out;
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
