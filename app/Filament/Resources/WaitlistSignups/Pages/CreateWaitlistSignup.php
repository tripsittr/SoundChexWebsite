<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\WaitlistSignups\Pages;

use App\Filament\Resources\WaitlistSignups\WaitlistSignupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWaitlistSignup extends CreateRecord
{
    protected static string $resource = WaitlistSignupResource::class;
}
