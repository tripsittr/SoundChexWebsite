<?php

namespace App\Filament\Resources\ReleaseNotes\Pages;

use App\Filament\Resources\ReleaseNotes\ReleaseNoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReleaseNote extends CreateRecord
{
    protected static string $resource = ReleaseNoteResource::class;
}
