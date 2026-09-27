<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

return [

    /*
    |--------------------------------------------------------------------------
    | Tracker API token (W-33)
    |--------------------------------------------------------------------------
    |
    | Set on the SERVER only, and never committed. Generate one with
    | `php artisan tracker:token` on the box and paste it into the site's .env.
    |
    | Unset means the API is off, and every request is refused with a 503. An
    | endpoint that accepts writes because nobody configured a token would be
    | worse than no endpoint at all.
    |
    */

    'token' => env('TRACKER_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Where the CLI writes (W-33)
    |--------------------------------------------------------------------------
    |
    | Set on the MAINTAINER'S MACHINE, not the server. With both of these set,
    | `track:issue` and `track:move` write to the live site instead of the
    | local SQLite file, which is the whole point: the board the owner reads
    | should be the one the work is logged to.
    |
    | Left unset, the commands write locally and say so. That is the right
    | default for a fresh clone — but it is also exactly how the two databases
    | drifted apart in the first place, so the commands announce which one they
    | wrote to every time rather than leaving it to be assumed.
    |
    */

    'remote' => [
        'url' => env('TRACKER_REMOTE_URL'),
        'token' => env('TRACKER_REMOTE_TOKEN'),
    ],

];
