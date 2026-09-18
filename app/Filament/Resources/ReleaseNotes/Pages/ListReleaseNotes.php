<?php

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
