<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeds the public roadmap items into the `items` table, so a fresh environment
 * shows the roadmap without needing the sibling repos present (as
 * `items:import` does). Idempotent: keyed on `ref`.
 *
 * The full internal backlog is imported separately with `php artisan items:import`
 * from the Markdown trackers; this seeder covers only the published roadmap.
 */
class RoadmapSeeder extends Seeder
{
    public function run(): void
    {
        // [ref, platform, title, status, type, summary]
        $planned = [
            ['S-151', 'server-desktop', 'Bundled production server (plug-and-play self-hosting)', 'planned', 'feature', 'One-click bundled server (PHP-FPM + Caddy) — install the app and the server just works, no dependencies.'],
            ['S-153', 'server-desktop', 'DLNA / UPnP media-server output', 'planned', 'feature', 'DLNA output — old TVs, consoles and receivers can play your library with no app.'],
            ['S-154', 'server-desktop', 'Cast receiver (be cast TO)', 'planned', 'feature', 'Cast to SoundChex — a Google Cast receiver and DLNA renderer, so a phone can send media to a SoundChex screen.'],
            ['IOS-21', 'ios', 'CarPlay', 'planned', 'feature', 'CarPlay — your library on the car screen.'],
            ['IOS-22', 'ios', 'AirPlay & Chromecast (sender)', 'planned', 'feature', 'Cast what you are playing to an Apple TV, HomePod, AirPlay speaker or Chromecast.'],
            ['IOS-TVOS', 'ios', 'Apple TV (tvOS) app', 'planned', 'feature', 'The same Swift core with a 10-foot living-room interface.'],
            ['A-01', 'android', 'Android app (phone & tablet)', 'in-progress', 'feature', 'Native Kotlin/Compose client with playback, offline and playlists — parity with iOS.'],
            ['A-08', 'android', 'Android TV & Google TV', 'planned', 'feature', 'A leanback, remote-navigable UI sharing the Android core.'],
            ['A-10', 'android', 'Android Auto', 'planned', 'feature', 'Your library on the car dashboard.'],
            ['A-11', 'android', 'Chromecast & AirPlay (sender)', 'planned', 'feature', 'Cast to a Chromecast, Google TV or AirPlay device.'],
            ['TV-01', 'tv', 'LG, Samsung & Vizio', 'planned', 'feature', 'One web app packaged for webOS, Tizen and SmartCast.'],
            ['R-01', 'roku', 'Roku channel', 'planned', 'feature', 'A native Roku channel (BrightScript / SceneGraph).'],
            ['S-09', 'scnet', 'SCNet relay', 'planned', 'feature', 'A managed relay so remote access is one toggle; an encrypted pipe to your own server.'],
            ['S-150', 'integrations', 'Voice & smart home', 'planned', 'feature', 'Alexa, Google Home, Apple Home/HomeKit, SmartThings.'],
        ];

        $available = [
            ['server-desktop', 'Self-hosted server', 'Scan your library, stream to any device, manage profiles and access. macOS, Windows, Linux.'],
            ['server-desktop', 'Desktop app', 'A native window onto your server on macOS, Windows and Linux.'],
            ['ios', 'iOS & iPadOS app', 'Native browse, playback, offline downloads, playlists, admin and lyrics — background audio and PiP.'],
            ['scnet', 'Remote access (self-managed)', 'Reach your server over your own tunnel today, free.'],
            ['integrations', 'Metadata providers', 'Configurable metadata sources for richer library detail.'],
        ];

        foreach ($planned as [$ref, $platform, $title, $status, $type, $summary]) {
            $item = Item::firstOrNew(['ref' => $ref]);
            $item->fill([
                'title' => $item->title ?: $title,
                'platform' => $platform,
                'status' => $status,
                'type' => $type,
                'public_summary' => $summary,
                'published' => true,
            ])->save();
        }

        foreach ($available as [$platform, $title, $summary]) {
            Item::updateOrCreate(
                ['ref' => 'RM-'.Str::slug($title)],
                [
                    'title' => $title,
                    'platform' => $platform,
                    'type' => 'feature',
                    'status' => 'available',
                    'public_summary' => $summary,
                    'published' => true,
                    'repo' => 'SoundChexWebsite',
                ]
            );
        }
    }
}
