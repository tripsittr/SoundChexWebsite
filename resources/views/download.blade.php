<x-layouts.site title="Download — SoundChex" description="Download SoundChex and SoundChex Server — free, open-source, self-hosted media library for macOS, Windows, Linux, iOS and Android.">
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100">Download</h1>
        <p class="mt-4 max-w-2xl text-ink-300">
            Two apps, both free. Every installer is compiled from the
            <a href="https://github.com/tripsittr/SoundChex" class="text-accent hover:text-accent-hot">public source</a>
            and published on GitHub Releases — no accounts, no installers-of-installers.
        </p>

        @php
            // Pinned to the tag rather than `releases/latest`, which GitHub
            // does not point at pre-releases (S-421).
            $clientBase = 'https://github.com/tripsittr/SoundChex/releases/tag/client-v0.2.0-beta.1';
        @endphp

        {{-- Said once, plainly, above everything it applies to. A badge on a
             row is easy to miss; the warnings these builds produce are not. --}}
        <div class="mt-8 rounded-xl border border-amber-500/30 bg-amber-500/10 p-5">
            <h2 class="text-sm font-bold text-amber-200">0.2.0 “Rough Cut” — beta</h2>
            <p class="mt-1 text-sm leading-relaxed text-amber-100/90">
                The first public build. <strong>macOS is used daily; Windows and
                Linux compile in CI and have not yet been run on those systems</strong> —
                they are here to be tested, not relied on.
            </p>
            <p class="mt-2 text-sm leading-relaxed text-amber-100/90">
                Nothing is code-signed yet, so both systems will warn you.
                macOS reports the app as <em>damaged</em>: right-click it and
                choose Open, or run
                <code class="rounded bg-black/30 px-1">xattr -dr com.apple.quarantine</code>
                on it. Windows shows “Windows protected your PC” — choose
                More&nbsp;info, then Run&nbsp;anyway.
            </p>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            {{-- The client --}}
            <div class="rounded-2xl border border-base-600 bg-base-700 p-8">
                <h2 class="text-xl font-bold text-ink-100">SoundChex</h2>
                <p class="mt-1 text-sm text-ink-300">The app for every device — browse, play, read and download your library.</p>
                <ul class="mt-6 space-y-3 text-sm">
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">macOS <span class="text-ink-500">(.dmg)</span></span>
                        <a href="{{ $clientBase }}" class="rounded-lg bg-accent px-4 py-1.5 font-semibold text-white transition-colors hover:bg-accent-hot">Download</a>
                    </li>
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">Windows <span class="text-ink-500">(.msi)</span></span>
                        <span class="flex items-center gap-2">
                            <span class="rounded-full bg-amber-500/15 px-2 py-0.5 text-xs font-semibold text-amber-300" title="Builds in CI; not yet run on Windows">Untested</span>
                            <a href="{{ $clientBase }}" class="rounded-lg bg-accent px-4 py-1.5 font-semibold text-white transition-colors hover:bg-accent-hot">Download</a>
                        </span>
                    </li>
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">Linux <span class="text-ink-500">(.deb / .AppImage)</span></span>
                        <span class="flex items-center gap-2">
                            <span class="rounded-full bg-amber-500/15 px-2 py-0.5 text-xs font-semibold text-amber-300" title="Builds in CI; not yet run on Linux">Untested</span>
                            <a href="{{ $clientBase }}" class="rounded-lg bg-accent px-4 py-1.5 font-semibold text-white transition-colors hover:bg-accent-hot">Download</a>
                        </span>
                    </li>
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">iOS / iPadOS</span>
                        <a href="{{ route('docs.show', 'app-ios') }}" class="text-accent transition-colors hover:text-accent-hot">Developer build →</a>
                    </li>
                    <li class="flex items-center justify-between gap-4">
                        <span class="text-ink-100">Android</span>
                        <span class="text-ink-500">Planned — <a href="{{ route('docs.show', 'app-android') }}" class="text-ink-300 underline decoration-base-500 hover:text-ink-100">web app today</a></span>
                    </li>
                </ul>
                <p class="mt-6 text-xs text-ink-500">
                    First launch on macOS: see <a href="{{ route('docs.show', 'dmg-setup') }}" class="text-accent hover:text-accent-hot">DMG setup</a> —
                    unsigned builds need one extra click past Gatekeeper.
                </p>
            </div>

            {{-- The server --}}
            <div class="rounded-2xl border border-base-600 bg-base-700 p-8">
                <h2 class="text-xl font-bold text-ink-100">SoundChex Server</h2>
                <p class="mt-1 text-sm text-ink-300">For the one machine that hosts the library — the server plus service controls.</p>
                <ul class="mt-6 space-y-3 text-sm">
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">macOS <span class="text-ink-500">(.dmg)</span></span>
                        <a href="https://github.com/tripsittr/SoundChex/releases/latest" class="rounded-lg bg-accent px-4 py-1.5 font-semibold text-white transition-colors hover:bg-accent-hot">Download</a>
                    </li>
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">Windows <span class="text-ink-500">(.exe)</span></span>
                        <span class="text-ink-500">Coming soon</span>
                    </li>
                    <li class="flex items-center justify-between gap-4">
                        <span class="text-ink-100">Any OS, from source</span>
                        <a href="{{ route('docs.show', 'github-setup') }}" class="text-accent transition-colors hover:text-accent-hot">GitHub setup →</a>
                    </li>
                </ul>
                <p class="mt-6 text-xs text-ink-500">
                    The server itself is a PHP application; the per-OS guides
                    (<a href="{{ route('docs.show', 'server-macos') }}" class="text-accent hover:text-accent-hot">macOS</a>,
                    <a href="{{ route('docs.show', 'server-windows') }}" class="text-accent hover:text-accent-hot">Windows</a>,
                    <a href="{{ route('docs.show', 'server-linux') }}" class="text-accent hover:text-accent-hot">Linux</a>)
                    cover hosting on each platform.
                </p>
            </div>
        </div>

        {{-- The bundled runtime — plug-and-play server, no PHP/Herd needed (S-151) --}}
        @php
            // Pinned to the beta tag, not `releases/latest`: GitHub excludes
            // pre-releases from "latest", so those links 404 while the only
            // release is a beta (S-421).
            $serverTag = 'server-v0.2.0-beta.1';
            $runtimeBase = "https://github.com/tripsittr/SoundChex/releases/download/{$serverTag}";

            // `tested` is not `ready`. A runtime can build and be downloadable
            // without anyone having run it, and saying otherwise on a public
            // page is a promise the project cannot keep.
            $runtimes = [
                ['os' => 'macOS', 'arch' => 'Apple silicon', 'file' => 'soundchex-server-macos-aarch64.tar.gz', 'ready' => true, 'tested' => true],
                ['os' => 'macOS', 'arch' => 'Intel', 'file' => 'soundchex-server-macos-x86_64.tar.gz', 'ready' => false, 'tested' => false],
                ['os' => 'Linux', 'arch' => 'x86_64', 'file' => 'soundchex-server-linux-x86_64.tar.gz', 'ready' => true, 'tested' => false],
                ['os' => 'Linux', 'arch' => 'ARM64', 'file' => 'soundchex-server-linux-aarch64.tar.gz', 'ready' => true, 'tested' => false],
                ['os' => 'Windows', 'arch' => 'x86_64', 'file' => 'soundchex-server-windows-x86_64.zip', 'ready' => true, 'tested' => false],
            ];
        @endphp
        <div class="mt-10 rounded-2xl border border-base-600 bg-base-700 p-8">
            <div class="flex flex-wrap items-baseline justify-between gap-2">
                <h2 class="text-xl font-bold text-ink-100">Bundled server runtime</h2>
                <span class="rounded-full bg-accent/15 px-2.5 py-0.5 text-xs font-semibold text-accent">Plug &amp; play</span>
            </div>
            <p class="mt-1 max-w-2xl text-sm text-ink-300">
                A self-contained runtime — PHP, php-fpm and Caddy in one relocatable
                bundle, with the CA bundle and config templates. No system PHP, no
                Herd, no setup: unpack it and the server runs. Normally installed by
                the app, but here for headless boxes and NAS.
            </p>
            <ul class="mt-6 grid gap-3 sm:grid-cols-2">
                @foreach ($runtimes as $rt)
                    <li class="flex items-center justify-between gap-4 rounded-lg border border-base-600/60 bg-base-800/50 px-4 py-3 text-sm">
                        <span class="text-ink-100">{{ $rt['os'] }} <span class="text-ink-500">({{ $rt['arch'] }})</span></span>
                        @if ($rt['ready'])
                            @unless ($rt['tested'])
                                <span class="rounded-full bg-amber-500/15 px-2 py-0.5 text-xs font-semibold text-amber-300" title="Builds in CI; not yet run on this operating system">Untested</span>
                            @endunless
                            <a href="{{ $runtimeBase }}/{{ $rt['file'] }}" class="rounded-lg bg-accent px-4 py-1.5 font-semibold text-white transition-colors hover:bg-accent-hot">Download</a>
                        @else
                            <span class="text-ink-500">Building in CI</span>
                        @endif
                    </li>
                @endforeach
            </ul>
            <p class="mt-6 text-xs text-ink-500">
                AGPLv3, with a bundled
                <span class="text-ink-300">THIRD-PARTY-LICENSES.txt</span>
                (PHP, Caddy, SQLite &amp; friends). Verify the download against the
                <code class="text-ink-300">.sha256</code> published beside it.
                Non-macOS builds compile on their own runners and appear as the
                pipeline finishes them.
            </p>
        </div>

        <div class="mt-10 rounded-xl border border-base-600 bg-base-800 p-6 text-sm text-ink-300">
            <p>
                <strong class="text-ink-100">All releases live on GitHub.</strong>
                The <a href="https://github.com/tripsittr/SoundChex/releases" class="text-accent hover:text-accent-hot">releases page</a>
                lists every version with its installers and changelog. To hear about new versions,
                watch the repository: <em>Watch → Custom → Releases</em>. Setup guides:
                <a href="{{ route('docs.show', 'dmg-setup') }}" class="text-accent hover:text-accent-hot">macOS (.dmg)</a> ·
                <a href="{{ route('docs.show', 'exe-setup') }}" class="text-accent hover:text-accent-hot">Windows (.exe)</a> ·
                <a href="{{ route('docs.show', 'github-setup') }}" class="text-accent hover:text-accent-hot">from source</a>.
            </p>
        </div>
    </section>
</x-layouts.site>
