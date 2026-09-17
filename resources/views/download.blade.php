<x-layouts.site title="Download — SoundChex" description="Download SoundChex and SoundChex Server — free, open-source, self-hosted media library for macOS, Windows, Linux, iOS and Android.">
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100">Download</h1>
        <p class="mt-4 max-w-2xl text-ink-300">
            Two apps, both free. Every installer is compiled from the
            <a href="https://github.com/tripsittr/SoundChex" class="text-accent hover:text-accent-hot">public source</a>
            and published on GitHub Releases — no accounts, no installers-of-installers.
        </p>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            {{-- The client --}}
            <div class="rounded-2xl border border-base-600 bg-base-700 p-8">
                <h2 class="text-xl font-bold text-ink-100">SoundChex</h2>
                <p class="mt-1 text-sm text-ink-300">The app for every device — browse, play, read and download your library.</p>
                <ul class="mt-6 space-y-3 text-sm">
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">macOS <span class="text-ink-500">(.dmg)</span></span>
                        <a href="https://github.com/tripsittr/SoundChex/releases/latest" class="rounded-lg bg-accent px-4 py-1.5 font-semibold text-white transition-colors hover:bg-accent-hot">Download</a>
                    </li>
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">Windows <span class="text-ink-500">(.exe)</span></span>
                        <span class="text-ink-500">Coming soon</span>
                    </li>
                    <li class="flex items-center justify-between gap-4 border-b border-base-600/60 pb-3">
                        <span class="text-ink-100">Linux <span class="text-ink-500">(.deb / .rpm / .AppImage)</span></span>
                        <span class="text-ink-500">Coming soon</span>
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
