<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bearer-token auth for the tracker API (W-33).
 *
 * A single shared token rather than per-user credentials, because there is one
 * writer: the maintainer's machine. Adding accounts and scopes to a one-person
 * tracker would be ceremony that protects nothing.
 *
 * The token lives in the server's env and is never committed. If it is unset,
 * every request is refused — an API that silently accepts writes because
 * nobody configured a token is worse than one that is switched off.
 */
class TrackerToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expected = (string) config('tracker.token');

        if ($expected === '') {
            return response()->json([
                'message' => 'The tracker API is not configured on this server.',
            ], 503);
        }

        $provided = (string) $request->bearerToken();

        // hash_equals, not ===, so a wrong token cannot be found a character
        // at a time by measuring how long the comparison takes.
        if ($provided === '' || ! hash_equals($expected, $provided)) {
            return response()->json(['message' => 'Bad tracker token.'], 401);
        }

        return $next($request);
    }
}
