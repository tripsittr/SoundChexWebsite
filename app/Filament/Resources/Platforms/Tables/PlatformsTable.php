<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\Platforms\Tables;

use App\Models\Platform;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PlatformsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('name')->searchable(),

                ToggleColumn::make('available')
                    ->label('Available')
                    ->onColor('success'),

                // A read-only preview of what the home grid renders for this
                // row. It shows `available` too, but must NOT be named
                // `available`: Filament keys its column map by name, so a second
                // column of that name displaces the ToggleColumn above in the
                // map (both still render, but only the last one is addressable).
                IconColumn::make('home_shows')
                    ->label('Home shows')
                    ->getStateUsing(fn (Platform $record): bool => $record->available)
                    ->trueIcon('heroicon-o-arrow-down-tray')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
