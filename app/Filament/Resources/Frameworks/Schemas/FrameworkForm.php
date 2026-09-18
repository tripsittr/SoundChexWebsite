<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\Frameworks\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FrameworkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->maxLength(60),

            TextInput::make('role')
                ->maxLength(60)
                ->helperText('Short subtitle, e.g. "PHP framework" or "Android UI".'),

            TextInput::make('url')
                ->url()
                ->maxLength(255)
                ->helperText('Project homepage.'),

            ColorPicker::make('color')
                ->helperText('Brand colour for the tile / logo tint.'),

            TextInput::make('logo_slug')
                ->maxLength(60)
                ->helperText('Logo file under public/images/credits/<slug>.svg. Leave blank for a monogram.'),

            TextInput::make('mono')
                ->label('Monogram')
                ->maxLength(8)
                ->helperText('Fallback text shown when there is no logo (e.g. "id3").'),

            TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }
}
