<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\Items\Schemas;

use App\Models\Item;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

/**
 * The pretty read-only view shown in the slide-over when a tracker row is
 * clicked. Grouped like the site: a header with the title and badges, then the
 * detail, then the roadmap/meta.
 */
class ItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->schema([
                    TextEntry::make('title')
                        ->hiddenLabel()
                        ->size(TextSize::Large)
                        ->columnSpanFull(),

                    Grid::make(4)->schema([
                        TextEntry::make('ref')
                            ->label('Reference')
                            ->badge()
                            ->placeholder('—'),

                        TextEntry::make('platform')
                            ->badge()
                            ->color('primary')
                            ->formatStateUsing(fn (string $state): string => Item::PLATFORMS[$state] ?? $state),

                        TextEntry::make('type')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => Item::TYPES[$state] ?? $state)
                            ->color(fn (string $state): string => match ($state) {
                                'bug' => 'danger',
                                'feature' => 'primary',
                                'chore' => 'warning',
                                default => 'gray',
                            }),

                        TextEntry::make('status')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => Item::STATUSES[$state] ?? $state)
                            ->color(fn (string $state): string => match ($state) {
                                'available', 'done' => 'success',
                                'in-progress' => 'warning',
                                'deferred' => 'danger',
                                default => 'gray',
                            }),
                    ]),
                ]),

            Section::make('Details')
                ->schema([
                    TextEntry::make('description')
                        ->hiddenLabel()
                        ->prose()
                        ->placeholder('No description.')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Roadmap & meta')
                ->columns(3)
                ->schema([
                    IconEntry::make('published')
                        ->label('On public roadmap')
                        ->boolean(),

                    TextEntry::make('priority')
                        ->badge()
                        ->formatStateUsing(fn (string $state): string => Item::PRIORITIES[$state] ?? $state)
                        ->color(fn (string $state): string => match ($state) {
                            'critical' => 'danger',
                            'high' => 'warning',
                            default => 'gray',
                        }),

                    TextEntry::make('repo')
                        ->badge()
                        ->placeholder('—'),

                    TextEntry::make('public_summary')
                        ->label('Public roadmap blurb')
                        ->placeholder('— (falls back to the description)')
                        ->columnSpanFull(),

                    TextEntry::make('sort_order')->label('Order'),
                    TextEntry::make('created_at')->dateTime()->label('Created'),
                    TextEntry::make('updated_at')->since()->label('Updated'),
                ]),
        ]);
    }
}
