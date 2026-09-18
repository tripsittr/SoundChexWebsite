{{-- SPDX-License-Identifier: AGPL-3.0-or-later --}}
{{-- Copyright (C) 2026 SoundChex --}}
<x-layouts.site
    title="Roadmap — SoundChex"
    description="Where SoundChex is and where it's going — the server, the desktop and mobile apps, TV platforms, and the SCNet network, as a branching tree by status.">

    <section class="mx-auto max-w-5xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100 sm:text-5xl">Roadmap</h1>
        <p class="mt-4 max-w-2xl text-ink-300">
            SoundChex is one self-hosted server that branches out to every device you own. This tree is
            an honest map of what works today, what's being built, and what's planned — a direction, not
            a delivery date. The detail for each platform lives in its
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
            // Group metadata (heading, icon, blurb) keyed by the platform value
            // stored on items. Items themselves come from the database (published
            // roadmap entries); this only styles the branches.
            $platformMeta = [
                'server-desktop' => ['Server & desktop', 'server', 'The Laravel server and the Tauri desktop app — the heart of a self-hosted library.'],
                'ios' => ['iPhone, iPad & Apple TV', 'apple', 'A native Swift app sharing one core across Apple devices.'],
                'android' => ['Android, Android TV & Fire TV', 'android', 'One Kotlin app for every Android form factor.'],
                'tv' => ['Smart TVs & streaming boxes', 'tv', 'The living room beyond Android — web-based TVs and Roku.'],
                'roku' => ['Roku', 'tv', 'A native Roku channel (BrightScript / SceneGraph).'],
                'scnet' => ['SCNet — the optional network', 'globe', 'Reach your own server from anywhere. Self-hosting is always free; SCNet is a paid convenience.'],
                'integrations' => ['Integrations', 'plug', 'Bringing SoundChex to the tools and assistants you already use.'],
                'web' => ['Web', 'globe', 'The browser media centre and this site.'],
                'meta' => ['Project', 'plug', 'Cross-cutting project work.'],
            ];

            // DB status → the tree's three visual states.
            $statusClass = ['available' => 'available', 'in-progress' => 'progress', 'planned' => 'planned'];

            // Build the groups from published items, in platform order, each
            // item ordered by sort_order then title.
            $published = \App\Models\Item::publishedForRoadmap()->groupBy('platform');
            $groups = [];
            foreach ($platformMeta as $key => [$heading, $icon, $blurb]) {
                $rows = $published->get($key);
                if (! $rows || $rows->isEmpty()) {
                    continue;
                }
                $groups[] = [
                    'heading' => $heading,
                    'icon' => $icon,
                    'blurb' => $blurb,
                    'items' => $rows->map(fn ($it) => [
                        $it->title,
                        $statusClass[$it->status] ?? 'planned',
                        $it->roadmapSummary(),
                        // The panel's updated_at — when the entry last changed —
                        // so the roadmap shows how fresh each item is.
                        optional($it->updated_at)->format('M j, Y'),
                    ])->all(),
                ];
            }

            // Fallback: if nothing is published yet, keep the original curated
            // content so the page is never empty during rollout.
            if (empty($groups)) {
            $groups = [
                [
                    'heading' => 'Server & desktop',
                    'icon' => 'server',
                    'blurb' => 'The Laravel server and the Tauri desktop app — the heart of a self-hosted library.',
                    'items' => [
                        ['Self-hosted server', 'available', 'Scan your library, stream to any device, manage profiles and access. macOS, Windows, Linux.'],
                        ['Desktop app', 'available', 'A native window onto your server on macOS, Windows and Linux.'],
                        ['One-click bundled server', 'progress', 'Ship the whole runtime inside the app and a headless installer — no dependencies to install.'],
                        ['DLNA output', 'planned', 'Advertise your library to DLNA devices — old smart TVs, consoles and receivers play with no app.'],
                        ['Cast to SoundChex (receiver)', 'planned', 'Be a target other devices cast to — a Google Cast receiver and DLNA renderer.'],
                    ],
                ],
                [
                    'heading' => 'iPhone, iPad & Apple TV',
                    'icon' => 'apple',
                    'blurb' => 'A native Swift app sharing one core across Apple devices.',
                    'items' => [
                        ['iOS & iPadOS app', 'available', 'Native browse, playback, offline downloads, playlists, admin and lyrics — background audio and PiP.'],
                        ['CarPlay', 'planned', 'Your library on the car screen with the CarPlay audio interface.'],
                        ['AirPlay & Chromecast (send)', 'planned', 'Cast what you\'re playing to an Apple TV, HomePod, AirPlay speaker or Chromecast.'],
                        ['Apple TV (tvOS)', 'planned', 'The same Swift core with a 10-foot living-room interface.'],
                    ],
                ],
                [
                    'heading' => 'Android, Android TV & Fire TV',
                    'icon' => 'android',
                    'blurb' => 'One Kotlin app for every Android form factor.',
                    'items' => [
                        ['Android phone & tablet', 'progress', 'Native Kotlin/Compose client with playback, offline and playlists — parity with iOS.'],
                        ['Android Auto', 'planned', 'Your library on the car\'s dashboard with the Android Auto media interface.'],
                        ['Chromecast & AirPlay (send)', 'planned', 'Cast what you\'re playing to a Chromecast, Google TV or AirPlay device.'],
                        ['Android TV & Google TV', 'planned', 'A leanback, remote-navigable UI sharing the Android core.'],
                        ['Amazon Fire TV', 'planned', 'The same Android app, through the Amazon Appstore.'],
                    ],
                ],
                [
                    'heading' => 'Smart TVs & streaming boxes',
                    'icon' => 'tv',
                    'blurb' => 'The living room beyond Android — web-based TVs and Roku.',
                    'items' => [
                        ['LG, Samsung & Vizio', 'planned', 'One web app packaged for webOS, Tizen and SmartCast.'],
                        ['Roku', 'planned', 'A native Roku channel (BrightScript / SceneGraph).'],
                    ],
                ],
                [
                    'heading' => 'SCNet — the optional network',
                    'icon' => 'globe',
                    'blurb' => 'Reach your own server from anywhere. Self-hosting is always free; SCNet is a paid convenience.',
                    'items' => [
                        ['Remote access (self-managed)', 'available', 'Reach your server over your own tunnel today, free.'],
                        ['SCNet relay', 'planned', 'A managed relay so remote access is one toggle — an encrypted pipe to your own server.'],
                    ],
                ],
                [
                    'heading' => 'Integrations',
                    'icon' => 'plug',
                    'blurb' => 'Bringing SoundChex to the tools and assistants you already use.',
                    'items' => [
                        ['Metadata providers', 'available', 'Configurable metadata sources for richer library detail.'],
                        ['Voice & smart home', 'planned', 'Alexa, Google Home, Apple Home/HomeKit, SmartThings.'],
                    ],
                ],
            ];
            } // end fallback

            $dot = ['available' => 'bg-emerald-400', 'progress' => 'bg-accent', 'planned' => 'bg-amber-400'];
            $ring = ['available' => 'ring-emerald-400/40', 'progress' => 'ring-accent/40', 'planned' => 'ring-amber-400/30'];
            $label = ['available' => 'Available', 'progress' => 'In progress', 'planned' => 'Planned'];
            $icons = [
                'server' => 'M4 5a2 2 0 012-2h12a2 2 0 012 2v3a2 2 0 01-2 2H6a2 2 0 01-2-2zM4 15a2 2 0 012-2h12a2 2 0 012 2v3a2 2 0 01-2 2H6a2 2 0 01-2-2z M8 7h.01M8 17h.01',
                'apple' => 'M16 3c0 1.5-1 3-2.5 3.2M12 8c-2.5 0-4.5 2-4.5 5.5C7.5 17 9.5 21 12 21s4.5-4 4.5-6.5C16.5 10 14.5 8 12 8z',
                'android' => 'M7 10a5 5 0 0110 0v6H7zM7 16v2M17 16v2M9 6L7.5 4M15 6l1.5-2M10 10h.01M14 10h.01',
                'tv' => 'M3 5h18v12H3zM8 21h8M12 17v4',
                'globe' => 'M12 3a9 9 0 100 18 9 9 0 000-18zM3 12h18M12 3c2.5 2.5 3.5 6 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-6-3.5-9s1-6.5 3.5-9z',
                'plug' => 'M9 3v6M15 3v6M6 9h12v3a6 6 0 01-12 0zM12 18v3',
            ];
        @endphp

        {{-- The tree: a central trunk with SoundChex at the root, each platform a
             branch, each feature a leaf. Connectors are drawn with borders so no
             script or SVG is needed. --}}
        <div class="relative mt-14">
            {{-- Root --}}
            <div class="relative z-10 mx-auto flex w-max items-center gap-3 rounded-2xl border border-base-500 bg-base-700 px-6 py-4 shadow-lg">
                <span class="flex size-9 items-center justify-center rounded-lg bg-accent/15 text-accent">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                </span>
                <span class="text-lg font-bold text-ink-100">SoundChex</span>
            </div>

            {{-- Trunk: a vertical line down the centre linking every branch. --}}
            <div class="relative mt-0 pt-8">
                <span class="pointer-events-none absolute left-1/2 top-0 hidden h-full w-px -translate-x-1/2 bg-base-600 lg:block"></span>

                <div class="space-y-6">
                    @foreach ($groups as $i => $group)
                        @php $left = $i % 2 === 0; @endphp
                        {{-- Branch node --}}
                        <div class="relative lg:grid lg:grid-cols-2 lg:gap-10">
                            {{-- connector stub from the trunk to this branch (desktop) --}}
                            <span class="pointer-events-none absolute top-8 left-1/2 hidden h-px w-8 bg-base-600 lg:block {{ $left ? '-translate-x-8' : '' }}"></span>
                            <span class="pointer-events-none absolute top-8 left-1/2 hidden size-2.5 -translate-x-1/2 rounded-full bg-base-500 ring-4 ring-base-900 lg:block"></span>

                            {{-- the card sits on the left or right of the trunk, alternating --}}
                            <div class="{{ $left ? 'lg:col-start-1' : 'lg:col-start-2' }}">
                                <div class="rounded-2xl border border-base-700 bg-base-800/60 p-5">
                                    <div class="flex items-center gap-3">
                                        <span class="flex size-10 shrink-0 items-center justify-center rounded-xl border border-base-600 bg-base-700 text-ink-200">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icons[$group['icon']] }}"/></svg>
                                        </span>
                                        <div>
                                            <h2 class="text-lg font-bold text-ink-100">{{ $group['heading'] }}</h2>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-ink-400">{{ $group['blurb'] }}</p>

                                    {{-- leaves --}}
                                    <ul class="mt-4 space-y-0">
                                        {{-- Curated-fallback tuples have no date (3 elements); pad so the
                                             4-way destructure never warns on the empty-DB path. --}}
                                        @foreach ($group['items'] as $j => $item)
                                            @php([$name, $status, $desc, $date] = $item + [3 => null])
                                            <li class="relative flex gap-3 py-2.5 pl-5
                                                       {{ $j < count($group['items']) - 1 ? 'border-b border-base-700/60' : '' }}">
                                                {{-- leaf connector: a small elbow --}}
                                                <span class="pointer-events-none absolute left-0 top-0 h-1/2 w-px bg-base-600"></span>
                                                <span class="pointer-events-none absolute left-0 top-1/2 w-3 border-t border-base-600"></span>
                                                @if (! $loop->last)
                                                    <span class="pointer-events-none absolute left-0 top-1/2 h-1/2 w-px bg-base-600"></span>
                                                @endif

                                                <span class="mt-1.5 size-2.5 shrink-0 rounded-full {{ $dot[$status] }} ring-4 {{ $ring[$status] }}"
                                                      title="{{ $label[$status] }}"></span>
                                                <div class="min-w-0">
                                                    <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                                                        <span class="font-semibold text-ink-100">{{ $name }}</span>
                                                        <span class="rounded-full border border-base-600 px-2 py-0.5 text-[11px] uppercase tracking-wide text-ink-500">{{ $label[$status] }}</span>
                                                        @if (! empty($date))
                                                            <span class="text-[11px] text-ink-500" title="Last updated">{{ $date }}</span>
                                                        @endif
                                                    </div>
                                                    <p class="mt-0.5 text-sm text-ink-300">{{ $desc }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-16 rounded-2xl border border-base-700 bg-base-800/50 p-6 text-center">
            <p class="text-ink-200">
                SoundChex is free and open source (AGPLv3). Follow along, file ideas, or contribute on
                <a href="https://github.com/tripsittr/SoundChex" class="text-accent hover:text-accent-hot">GitHub</a>.
            </p>
        </div>
    </section>
</x-layouts.site>
