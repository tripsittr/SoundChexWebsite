<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\ReleaseNotes\Tables;

use App\Models\Item;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReleaseNotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('released_on', 'desc')
            ->columns([
                TextColumn::make('released_on')->label('Date')->date()->sortable(),
                TextColumn::make('version')->badge()->placeholder('—'),
                TextColumn::make('title')->searchable()->wrap()->limit(60),
                TextColumn::make('platform')
                    ->badge()
                    ->placeholder('—')
                    ->formatStateUsing(fn (?string $state): string => $state ? (Item::PLATFORMS[$state] ?? $state) : '—'),
                IconColumn::make('published')->boolean(),
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
