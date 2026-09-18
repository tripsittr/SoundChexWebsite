<?php

namespace App\Filament\Resources\ReleaseNotes\Pages;

use App\Filament\Resources\ReleaseNotes\ReleaseNoteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReleaseNote extends EditRecord
{
    protected static string $resource = ReleaseNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
