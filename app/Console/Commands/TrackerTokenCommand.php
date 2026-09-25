<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Generates a tracker API token (W-33).
 *
 * Run on the server, then paste the value into that machine's `.env` as
 * `TRACKER_API_TOKEN`, and into the maintainer's `.env` as
 * `TRACKER_REMOTE_TOKEN`. It is printed once and not stored anywhere else —
 * a token in the repository is not a token.
 */
class TrackerTokenCommand extends Command
{
    protected $signature = 'tracker:token';

    protected $description = 'Generate a token for the tracker API';

    public function handle(): int
    {
        $token = bin2hex(random_bytes(32));

        $this->newLine();
        $this->line('  <fg=gray>Token (shown once):</>');
        $this->line("  <fg=green>{$token}</>");
        $this->newLine();
        $this->line('  <fg=gray>On the SERVER, in .env:</>');
        $this->line("      TRACKER_API_TOKEN={$token}");
        $this->newLine();
        $this->line('  <fg=gray>On the machine you work from, in .env:</>');
        $this->line('      TRACKER_REMOTE_URL=https://soundchex.app');
        $this->line("      TRACKER_REMOTE_TOKEN={$token}");
        $this->newLine();
        $this->line('  <fg=gray>Then `php artisan config:clear` on the server.</>');
        $this->newLine();

        return self::SUCCESS;
    }
}
