<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\WaitlistSignups;

use App\Filament\Resources\WaitlistSignups\Pages\CreateWaitlistSignup;
use App\Filament\Resources\WaitlistSignups\Pages\EditWaitlistSignup;
use App\Filament\Resources\WaitlistSignups\Pages\ListWaitlistSignups;
use App\Filament\Resources\WaitlistSignups\Schemas\WaitlistSignupForm;
use App\Filament\Resources\WaitlistSignups\Tables\WaitlistSignupsTable;
use App\Models\WaitlistSignup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WaitlistSignupResource extends Resource
{
    protected static ?string $model = WaitlistSignup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $navigationLabel = 'SCNet waitlist';

    protected static ?string $modelLabel = 'signup';

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 10;

    public static function getNavigationBadge(): ?string
    {
        return (string) WaitlistSignup::count();
    }

    public static function form(Schema $schema): Schema
    {
        return WaitlistSignupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WaitlistSignupsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWaitlistSignups::route('/'),
            'create' => CreateWaitlistSignup::route('/create'),
            'edit' => EditWaitlistSignup::route('/{record}/edit'),
        ];
    }
}
