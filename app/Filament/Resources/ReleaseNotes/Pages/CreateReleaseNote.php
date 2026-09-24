<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\ReleaseNotes\Pages;

use App\Filament\Resources\ReleaseNotes\ReleaseNoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReleaseNote extends CreateRecord
{
    protected static string $resource = ReleaseNoteResource::class;
}
