<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\ReleaseNotes\Schemas;

use App\Models\Item;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReleaseNoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(120)
                        ->columnSpanFull()
                        ->helperText('e.g. "0.4.1 — Interlude" or "Playlists land on iOS".'),

                    TextInput::make('version')
                        ->maxLength(40)
                        ->helperText('Optional — the version number.'),

                    Select::make('platform')
                        ->options(Item::PLATFORMS)
                        ->searchable()
                        ->helperText('Optional — which app/area this release is for.'),

                    DatePicker::make('released_on')
                        ->default(now())
                        ->native(false),

                    Toggle::make('published')
                        ->default(true)
                        ->helperText('Off = hidden from the public /changelog.'),
                ]),

            Section::make('What changed')
                ->schema([
                    MarkdownEditor::make('body')
                        ->hiddenLabel()
                        ->required()
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
