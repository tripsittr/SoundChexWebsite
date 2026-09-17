{{-- SPDX-License-Identifier: AGPL-3.0-or-later --}}
{{-- Copyright (C) 2026 SoundChex --}}
<x-layouts.site
    title="Roadmap — SoundChex"
    description="Where SoundChex is and where it's going — the server, the desktop and mobile apps, TV platforms, and the SCNet network, by status.">

    <section class="mx-auto max-w-4xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100 sm:text-5xl">Roadmap</h1>
        <p class="mt-4 max-w-2xl text-ink-300">
            SoundChex is one self-hosted server and a growing set of native apps — one library,
            every device. This is an honest map of what works today, what's being built, and what's
            planned. It's a direction, not a delivery date; the detail for each platform lives in its
            <a href="https://github.com/tripsittr" class="text-accent hover:text-accent-hot">GitHub repository</a>.
        </p>

        {{-- Legend --}}
        <div class="mt-8 flex flex-wrap gap-3 text-sm">
            <span class="inline-flex items-center gap-2 rounded-full border border-base-600 bg-base-800 px-3 py-1">
                <span class="size-2 rounded-full bg-emerald-400"></span><span class="text-ink-200">Available</span>
            </span>
            <span class="inline-flex items-center gap-2 rounded-full border border-base-600 bg-base-800 px-3 py-1">
                <span class="size-2 rounded-full bg-accent"></span><span class="text-ink-200">In progress</span>
            </span>
            <span class="inline-flex items-center gap-2 rounded-full border border-base-600 bg-base-800 px-3 py-1">
                <span class="size-2 rounded-full bg-amber-400"></span><span class="text-ink-200">Planned</span>
            </span>
        </div>

        @php
            // status: available | progress | planned
            $groups = [
                [
                    'heading' => 'Server & desktop',
                    'blurb' => 'The Laravel server and the Tauri desktop app — the heart of a self-hosted library.',
                    'items' => [
                        ['Self-hosted server (macOS, Windows, Linux)', 'available', 'Scan your library, stream to any device, manage profiles and access.'],
                        ['Desktop app', 'available', 'A native window onto your server on macOS, Windows and Linux.'],
                        ['One-click bundled server', 'progress', 'Ship the whole runtime (PHP-FPM + Caddy) inside the app and a headless installer — no dependencies to install.'],
                        ['DLNA output', 'planned', 'Advertise your library to DLNA devices on your network — old smart TVs, game consoles and receivers can play from it with no app.'],
                    ],
                ],
                [
                    'heading' => 'iPhone, iPad & Apple TV',
                    'blurb' => 'A native Swift app sharing one core across Apple devices.',
                    'items' => [
                        ['iOS & iPadOS app', 'available', 'Native browse, playback, offline downloads, playlists, admin and lyrics — background audio and Picture in Picture.'],
                        ['CarPlay', 'planned', 'Your library on the car screen — browse and play with the CarPlay audio interface.'],
                        ['AirPlay & Chromecast', 'planned', 'Cast what you\'re playing to an Apple TV, HomePod, AirPlay speaker or Chromecast.'],
                        ['Apple TV (tvOS)', 'planned', 'The same Swift core with a 10-foot living-room interface.'],
                    ],
                ],
                [
                    'heading' => 'Android, Android TV, Google TV & Fire TV',
                    'blurb' => 'One Kotlin app for every Android form factor.',
                    'items' => [
                        ['Android phone & tablet', 'progress', 'Native Kotlin/Compose client with playback, offline and playlists — parity with iOS.'],
                        ['Android Auto', 'planned', 'Your library on the car\'s dashboard, using the Android Auto media interface.'],
                        ['Chromecast & AirPlay', 'planned', 'Cast what you\'re playing to a Chromecast, Google TV, or AirPlay device.'],
                        ['Android TV & Google TV', 'planned', 'A leanback, remote-navigable UI sharing the Android core.'],
                        ['Amazon Fire TV', 'planned', 'The same Android app, distributed through the Amazon Appstore.'],
                    ],
                ],
                [
                    'heading' => 'Smart TVs & streaming boxes',
                    'blurb' => 'The living room beyond Android — web-based TVs and Roku.',
                    'items' => [
                        ['LG (webOS), Samsung (Tizen), Vizio (SmartCast)', 'planned', 'One web app packaged for the smart-TV platforms.'],
                        ['Roku', 'planned', 'A native Roku channel (BrightScript / SceneGraph).'],
                    ],
                ],
                [
                    'heading' => 'SCNet — the optional network',
                    'blurb' => 'Reach your own server from anywhere. Self-hosting is always free; SCNet is a paid convenience, and the app stays open source.',
                    'items' => [
                        ['Remote access (self-managed)', 'available', 'Reach your server over your own tunnel today, free.'],
                        ['SCNet relay', 'planned', 'A managed relay so remote access is one toggle — an encrypted pipe to your own server; we never store or serve your media.'],
                    ],
                ],
                [
                    'heading' => 'Integrations',
                    'blurb' => 'Bringing SoundChex to the tools and assistants you already use.',
                    'items' => [
                        ['Metadata providers', 'available', 'Configurable metadata sources for richer library detail.'],
                        ['Voice & smart home', 'planned', 'Alexa, Google Home, Apple Home/HomeKit, SmartThings — control and cast targets.'],
                    ],
                ],
            ];
            $dot = ['available' => 'bg-emerald-400', 'progress' => 'bg-accent', 'planned' => 'bg-amber-400'];
            $label = ['available' => 'Available', 'progress' => 'In progress', 'planned' => 'Planned'];
        @endphp

        <div class="mt-14 space-y-12">
            @foreach ($groups as $group)
                <div>
                    <h2 class="text-2xl font-bold text-ink-100">{{ $group['heading'] }}</h2>
                    <p class="mt-1 max-w-2xl text-sm text-ink-400">{{ $group['blurb'] }}</p>

                    <ul class="mt-5 space-y-3">
                        @foreach ($group['items'] as [$name, $status, $desc])
                            <li class="flex gap-4 rounded-xl border border-base-700 bg-base-800/50 p-4">
                                <span class="mt-1.5 size-2.5 shrink-0 rounded-full {{ $dot[$status] }}"
                                      title="{{ $label[$status] }}"></span>
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                        <span class="font-semibold text-ink-100">{{ $name }}</span>
                                        <span class="rounded-full border border-base-600 px-2 py-0.5 text-xs text-ink-400">{{ $label[$status] }}</span>
                                    </div>
                                    <p class="mt-1 text-sm text-ink-300">{{ $desc }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-16 rounded-2xl border border-base-700 bg-base-800/50 p-6 text-center">
            <p class="text-ink-200">
                SoundChex is free and open source (AGPLv3). Follow along, file ideas, or contribute on
                <a href="https://github.com/tripsittr/SoundChex" class="text-accent hover:text-accent-hot">GitHub</a>.
            </p>
        </div>
    </section>
</x-layouts.site>
