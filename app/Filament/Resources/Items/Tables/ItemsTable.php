<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\Items\Tables;

use App\Models\Item;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('ref')
                    ->label('Ref')
                    ->badge()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('title')
                    ->searchable()
                    ->wrap()
                    ->limit(60),

                TextColumn::make('platform')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Item::PLATFORMS[$state] ?? $state)
                    ->sortable(),

                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Item::TYPES[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'feature' => 'primary',
                        'bug' => 'danger',
                        'chore' => 'warning',
                        default => 'gray',
                    }),

                // `colors()` matches each condition with `===`, so an array of
                // states (['available', 'done']) never matches and those badges
                // silently fell back to primary. `color()` with a match handles
                // the shared-colour case properly — and mirrors ItemInfolist.
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Item::STATUSES[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'available', 'done' => 'success',
                        'in-progress' => 'warning',
                        'deferred' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                IconColumn::make('published')
                    ->label('On roadmap')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('platform')->options(Item::PLATFORMS),
                SelectFilter::make('status')->options(Item::STATUSES),
                SelectFilter::make('type')->options(Item::TYPES),
                SelectFilter::make('repo')->options(Item::REPOS),
                TernaryFilter::make('published')->label('On public roadmap'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->slideOver()
                    ->modalHeading('Item'),
                EditAction::make(),
            ])
            // Clicking a row opens the pretty slide-over rather than the edit page.
            // recordUrl(null) is required so the row action wins over the
            // resource's default edit URL.
            ->recordAction('view')
            ->recordUrl(null)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
