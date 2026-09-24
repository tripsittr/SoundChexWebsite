<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\ReleaseNotes;

use App\Filament\Resources\ReleaseNotes\Pages\CreateReleaseNote;
use App\Filament\Resources\ReleaseNotes\Pages\EditReleaseNote;
use App\Filament\Resources\ReleaseNotes\Pages\ListReleaseNotes;
use App\Filament\Resources\ReleaseNotes\Schemas\ReleaseNoteForm;
use App\Filament\Resources\ReleaseNotes\Tables\ReleaseNotesTable;
use App\Models\ReleaseNote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReleaseNoteResource extends Resource
{
    protected static ?string $model = ReleaseNote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel = 'Changelog';

    protected static ?string $modelLabel = 'release note';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return ReleaseNoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReleaseNotesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReleaseNotes::route('/'),
            'create' => CreateReleaseNote::route('/create'),
            'edit' => EditReleaseNote::route('/{record}/edit'),
        ];
    }
}
