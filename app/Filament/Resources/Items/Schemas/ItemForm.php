<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\Items\Schemas;

use App\Models\Item;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('What')
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->rows(4)
                        ->columnSpanFull()
                        ->helperText('Internal detail — the full description of the todo/issue.'),

                    Select::make('type')
                        ->options(Item::TYPES)
                        ->default('todo')
                        ->required(),

                    Select::make('priority')
                        ->options(Item::PRIORITIES)
                        ->default('normal')
                        ->required(),
                ]),

            Section::make('Where')
                ->columns(2)
                ->schema([
                    Select::make('platform')
                        ->options(Item::PLATFORMS)
                        ->required()
                        ->searchable()
                        ->helperText('Which platform/area — also decides where it lands on the roadmap.'),

                    Select::make('repo')
                        ->options(Item::REPOS)
                        ->searchable()
                        ->helperText('Which repository the work lives in (optional).'),

                    TextInput::make('ref')
                        ->label('Reference id')
                        ->maxLength(50)
                        ->helperText('Original tracker id (S-151, IOS-21, W-29…), if any.'),

                    Select::make('status')
                        ->options(Item::STATUSES)
                        ->default('planned')
                        ->required(),
                ]),

            Section::make('Roadmap')
                ->columns(2)
                ->schema([
                    Toggle::make('published')
                        ->label('Show on public roadmap')
                        ->helperText('Off = internal todo/issue. On = published to the public /roadmap.')
                        ->live(),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->helperText('Lower shows first within its platform group.'),

                    Textarea::make('public_summary')
                        ->rows(2)
                        ->columnSpanFull()
                        ->maxLength(500)
                        ->helperText('Public-facing blurb for the roadmap card. Falls back to the description if blank.'),
                ]),
        ]);
    }
}
