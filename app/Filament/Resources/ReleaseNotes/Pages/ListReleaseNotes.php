<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\ReleaseNotes\Pages;

use App\Filament\Resources\ReleaseNotes\ReleaseNoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReleaseNotes extends ListRecords
{
    protected static string $resource = ReleaseNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
