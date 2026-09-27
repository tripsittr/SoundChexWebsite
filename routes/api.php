<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

use App\Http\Controllers\Api\TrackerController;
use App\Http\Middleware\TrackerToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tracker API (W-33)
|--------------------------------------------------------------------------
|
| So the maintainer's CLI writes to the tracker the owner actually reads.
| Work used to be logged into a local copy of the SQLite file, which meant
| the live board quietly fell behind.
|
| Every route is behind a shared bearer token, and the token being unset
| turns the API off rather than opening it up.
|
*/

Route::prefix('tracker')->middleware(TrackerToken::class)->group(function (): void {
    Route::get('/items', [TrackerController::class, 'index'])->name('api.tracker.index');
    Route::post('/items', [TrackerController::class, 'store'])->name('api.tracker.store');
    Route::patch('/items/{item}', [TrackerController::class, 'update'])->name('api.tracker.update');

    // One-time reconciliation of the two databases, and a restore path for a
    // `track:export` snapshot. Ids are preserved — see the controller.
    Route::post('/import', [TrackerController::class, 'import'])->name('api.tracker.import');
});
