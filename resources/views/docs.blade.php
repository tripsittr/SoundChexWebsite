<x-layouts.site title="Documentation — SoundChex" description="Install, set up, integrate, configure and customize SoundChex — the free, self-hosted media library.">
    @php
        $repo = 'https://github.com/tripsittr/SoundChex/blob/main';
    @endphp

    <section class="mx-auto max-w-4xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100">Documentation</h1>
        <p class="mt-4 text-ink-300">
            The guides live alongside the code on
            <a href="https://github.com/tripsittr/SoundChex" class="text-accent transition-colors hover:text-accent-hot">GitHub</a>,
            so they always match the version you're running. This page is the map.
        </p>

        <div class="mt-12 space-y-12">
            <div id="install" class="scroll-mt-24">
                <h2 class="text-2xl font-bold text-ink-100">Install</h2>
                <p class="mt-2 text-sm text-ink-300">Getting the server and apps onto your machines.</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ $repo }}/README.md" class="text-accent transition-colors hover:text-accent-hot">Quickstart</a> <span class="text-ink-500">— clone to playing in six commands (macOS &amp; Linux)</span></li>
                    <li><a href="{{ $repo }}/docs/SettingUpOnWindows.md" class="text-accent transition-colors hover:text-accent-hot">Setting up on Windows</a> <span class="text-ink-500">— step by step, including the PHP certificate-bundle fix</span></li>
                    <li><a href="{{ $repo }}/docs/BuildingOnEachPlatform.md" class="text-accent transition-colors hover:text-accent-hot">Building the apps on each platform</a> <span class="text-ink-500">— what each target needs, and which are built today</span></li>
                </ul>
            </div>

            <div id="setup" class="scroll-mt-24">
                <h2 class="text-2xl font-bold text-ink-100">Setup</h2>
                <p class="mt-2 text-sm text-ink-300">First run: pointing SoundChex at your media and keeping it fed.</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><span class="text-ink-100">Watch folders &amp; first scan</span> <span class="text-ink-500">— Admin → Library settings → watch folders, then <code class="rounded bg-base-700 px-1.5 py-0.5 font-mono text-xs">php artisan library:scan</code></span></li>
                    <li><span class="text-ink-100">Background workers</span> <span class="text-ink-500">— <code class="rounded bg-base-700 px-1.5 py-0.5 font-mono text-xs">queue:work</code> for enrichment, transcoding and downloads; <code class="rounded bg-base-700 px-1.5 py-0.5 font-mono text-xs">schedule:work</code> for scanning, backups and pruning</span></li>
                    <li><a href="{{ $repo }}/README.md" class="text-accent transition-colors hover:text-accent-hot">Full setup notes in the README</a> <span class="text-ink-500">— including the easy-to-miss <code class="rounded bg-base-700 px-1.5 py-0.5 font-mono text-xs">storage:link</code> step</span></li>
                </ul>
            </div>

            <div id="integrations" class="scroll-mt-24">
                <h2 class="text-2xl font-bold text-ink-100">Integrations</h2>
                <p class="mt-2 text-sm text-ink-300">Metadata sources and the tools SoundChex plays nicely with.</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><span class="text-ink-100">Metadata sources</span> <span class="text-ink-500">— TMDB, MusicBrainz, AcoustID, Open Library, iTunes, Spotify, OpenSubtitles and file tags. Keys for the ones that need them go in Admin → Metadata sources; sources without keys skip themselves and say so in the log.</span></li>
                    <li><span class="text-ink-100">File layout compatibility</span> <span class="text-ink-500">— libraries are organised the way Plex, Jellyfin and Emby already read, so other tools keep working.</span></li>
                    <li><span class="text-ink-500">A dedicated integrations guide is in progress — <a href="https://github.com/tripsittr/SoundChex/issues" class="text-accent transition-colors hover:text-accent-hot">ask on GitHub</a> in the meantime.</span></li>
                </ul>
            </div>

            <div id="configuration" class="scroll-mt-24">
                <h2 class="text-2xl font-bold text-ink-100">Configuration</h2>
                <p class="mt-2 text-sm text-ink-300">Remote access, moving servers, backups.</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ $repo }}/docs/MovingAServer.md" class="text-accent transition-colors hover:text-accent-hot">Moving a server</a> <span class="text-ink-500">— taking your library to a new machine intact</span></li>
                    <li><span class="text-ink-100">Remote access</span> <span class="text-ink-500">— the app races every address it knows and takes the fastest that answers; bring your own tunnel or wait for SCNet. A user guide is in progress.</span></li>
                </ul>
            </div>

            <div id="customization" class="scroll-mt-24">
                <h2 class="text-2xl font-bold text-ink-100">Customization</h2>
                <p class="mt-2 text-sm text-ink-300">Profiles, kids mode, and library settings.</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><span class="text-ink-100">Profiles &amp; kids mode</span> <span class="text-ink-500">— per-person history, resume points and watchlists; rating caps that hold across browsing, search and direct links.</span></li>
                    <li><span class="text-ink-500">A full customization guide is in progress — <a href="https://github.com/tripsittr/SoundChex/issues" class="text-accent transition-colors hover:text-accent-hot">open an issue</a> if something you need isn't covered yet.</span></li>
                </ul>
            </div>
        </div>
    </section>
</x-layouts.site>
