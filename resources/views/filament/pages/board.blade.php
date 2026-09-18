{{-- SPDX-License-Identifier: AGPL-3.0-or-later --}}
{{-- Copyright (C) 2026 SoundChex --}}
<x-filament-panels::page>
    @php
        $columns = $this->getColumns();
        $statusRing = [
            'planned' => 'ring-gray-500/40',
            'in-progress' => 'ring-amber-400/50',
            'available' => 'ring-emerald-400/50',
            'deferred' => 'ring-rose-400/50',
            'done' => 'ring-emerald-500/30',
        ];
        $dot = [
            'planned' => 'bg-gray-400',
            'in-progress' => 'bg-amber-400',
            'available' => 'bg-emerald-400',
            'deferred' => 'bg-rose-400',
            'done' => 'bg-emerald-500',
        ];
        $typeColor = [
            'bug' => 'text-rose-300 bg-rose-500/10',
            'feature' => 'text-primary-300 bg-primary-500/10',
            'chore' => 'text-amber-300 bg-amber-500/10',
            'todo' => 'text-gray-300 bg-gray-500/10',
        ];
    @endphp

    {{-- Platform filter chips --}}
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <button type="button" wire:click="setPlatform(null)"
                @class(['rounded-full px-3 py-1 text-xs font-medium transition',
                    'bg-primary-600 text-white' => $platform === null,
                    'bg-gray-800 text-gray-300 hover:bg-gray-700' => $platform !== null])>
            All
        </button>
        @foreach ($this->getPlatforms() as $key => $label)
            <button type="button" wire:click="setPlatform('{{ $key }}')"
                    @class(['rounded-full px-3 py-1 text-xs font-medium transition',
                        'bg-primary-600 text-white' => $platform === $key,
                        'bg-gray-800 text-gray-300 hover:bg-gray-700' => $platform !== $key])>
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- The board: horizontally scrolling columns (columns are drag-reorderable
         via their header handle; cards drag between columns to change status). --}}
    <div
        x-data="kanbanBoard()"
        x-init="init()"
        class="kanban-board flex gap-4 overflow-x-auto pb-4"
    >
        @foreach ($columns as $status => $col)
            <div class="kanban-col flex w-80 shrink-0 flex-col rounded-xl border border-gray-700 bg-gray-900/60"
                 data-column="{{ $status }}">
                {{-- Column header (drag handle for reordering columns) --}}
                <div class="kanban-col-handle flex cursor-grab items-center justify-between border-b border-gray-700 px-4 py-3 active:cursor-grabbing">
                    <div class="flex items-center gap-2">
                        <svg class="size-3.5 text-gray-600" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.6"/><circle cx="15" cy="6" r="1.6"/><circle cx="9" cy="12" r="1.6"/><circle cx="15" cy="12" r="1.6"/><circle cx="9" cy="18" r="1.6"/><circle cx="15" cy="18" r="1.6"/></svg>
                        <span class="size-2.5 rounded-full {{ $dot[$status] ?? 'bg-gray-400' }}"></span>
                        <span class="text-sm font-semibold text-gray-100">{{ $col['label'] }}</span>
                    </div>
                    <span class="rounded-full bg-gray-800 px-2 py-0.5 text-xs text-gray-400">{{ $col['total'] }}</span>
                </div>

                {{-- Cards (sortable between columns; click to open the slide-over) --}}
                <div
                    class="kanban-column flex min-h-24 flex-1 flex-col gap-2 p-2"
                    data-status="{{ $status }}"
                >
                    @foreach ($col['items'] as $item)
                        <div
                            class="kanban-card group cursor-pointer rounded-lg border border-gray-700 bg-gray-800 p-3 shadow-sm ring-1 ring-transparent transition hover:border-gray-500 {{ $statusRing[$status] ?? '' }}"
                            data-id="{{ $item->id }}"
                            wire:key="card-{{ $item->id }}"
                            x-on:click="if (!$el.dataset.dragging) $wire.mountAction('viewItem', { item: {{ $item->id }} })"
                        >
                            <div class="flex items-start justify-between gap-2">
                                <p class="text-sm font-medium leading-snug text-gray-100">{{ $item->title }}</p>
                                @if ($item->published)
                                    <span title="On public roadmap" class="mt-0.5 shrink-0 text-emerald-400">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                @endif
                            </div>

                            <div class="mt-2 flex flex-wrap items-center gap-1.5">
                                @if ($item->ref)
                                    <span class="rounded bg-gray-900 px-1.5 py-0.5 text-[10px] font-medium text-gray-400">{{ $item->ref }}</span>
                                @endif
                                <span class="rounded px-1.5 py-0.5 text-[10px] font-medium {{ $typeColor[$item->type] ?? 'text-gray-300 bg-gray-500/10' }}">{{ \App\Models\Item::TYPES[$item->type] ?? $item->type }}</span>
                                <span class="rounded bg-gray-900 px-1.5 py-0.5 text-[10px] text-gray-400">{{ \App\Models\Item::PLATFORMS[$item->platform] ?? $item->platform }}</span>
                            </div>
                        </div>
                    @endforeach

                    @if ($col['extra'] > 0)
                        <p class="px-1 py-2 text-center text-xs text-gray-500">+{{ $col['extra'] }} more</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- SortableJS-powered drag between columns → wire:moveCard --}}
    @assets
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"></script>
    @endassets

    @script
    <script>
        Alpine.data('kanbanBoard', () => ({
            init() {
                const component = this.$wire;

                // Cards: drag between columns to change status.
                this.$el.querySelectorAll('.kanban-column').forEach((col) => {
                    new Sortable(col, {
                        group: 'kanban-cards',
                        animation: 150,
                        ghostClass: 'opacity-40',
                        draggable: '.kanban-card',
                        // Flag the card as dragging so the click handler doesn't
                        // also fire and open the slide-over after a drag.
                        onStart: (evt) => { evt.item.dataset.dragging = '1'; },
                        onEnd: (evt) => {
                            const card = evt.item;
                            const id = parseInt(card.dataset.id, 10);
                            const status = evt.to.dataset.status;
                            if (id && status) {
                                component.moveCard(id, status);
                            }
                            // Clear the flag after the click event would have fired.
                            setTimeout(() => { delete card.dataset.dragging; }, 50);
                        },
                    });
                });

                // Columns: drag by the header handle to reorder the board.
                new Sortable(this.$el, {
                    group: 'kanban-columns',
                    animation: 150,
                    draggable: '.kanban-col',
                    handle: '.kanban-col-handle',
                    ghostClass: 'opacity-40',
                    onEnd: () => {
                        const order = [...this.$el.querySelectorAll('.kanban-col')]
                            .map((c) => c.dataset.column);
                        component.saveColumnOrder(order);
                    },
                });
            },
        }));
    </script>
    @endscript
</x-filament-panels::page>
