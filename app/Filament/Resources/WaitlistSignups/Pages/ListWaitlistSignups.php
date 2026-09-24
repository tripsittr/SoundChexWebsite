<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\WaitlistSignups\Pages;

use App\Filament\Resources\WaitlistSignups\WaitlistSignupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWaitlistSignups extends ListRecords
{
    protected static string $resource = WaitlistSignupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
