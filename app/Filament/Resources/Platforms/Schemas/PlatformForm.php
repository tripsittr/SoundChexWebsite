<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\Platforms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlatformForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(60)
                ->helperText('As shown in the home "Runs where you do" grid.'),

            Toggle::make('available')
                ->label('Available')
                ->helperText('On = a Download link. Off = "Coming soon".'),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0)
                ->helperText('Lower shows first.'),
        ]);
    }
}
