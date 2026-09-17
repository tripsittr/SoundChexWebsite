<x-layouts.site>
    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="mx-auto max-w-6xl px-4 pt-20 pb-16 text-center sm:px-6 sm:pt-28">
            <p class="mb-4 text-sm font-semibold tracking-wide text-accent uppercase">Free &amp; open source</p>
            <h1 class="mx-auto max-w-3xl text-4xl font-extrabold tracking-tight text-ink-100 sm:text-6xl">
                Your media. Your machine.<br class="hidden sm:block">
                <span class="text-accent">Every device.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-ink-300">
                SoundChex is a free, open-source library for your music, films, TV and books —
                one catalogue, one player, self-hosted so your files never leave home.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="#download" class="rounded-lg bg-accent px-6 py-3 font-semibold text-white transition-colors hover:bg-accent-hot">
                    Download
                </a>
                <a href="https://github.com/tripsittr/SoundChex" class="rounded-lg border border-base-500 px-6 py-3 font-semibold text-ink-100 transition-colors hover:border-ink-500 hover:bg-base-700">
                    View on GitHub
                </a>
            </div>
            {{-- Waveform motif, echoing the wordmark's underline --}}
            <div class="mt-16 flex items-end justify-center gap-1.5 opacity-80" aria-hidden="true">
                @foreach ([12, 22, 36, 18, 44, 60, 30, 52, 72, 40, 64, 84, 56, 72, 44, 60, 32, 48, 20, 36, 14, 24, 10] as $i => $h)
                    <span class="w-1.5 rounded-full {{ $i % 4 === 2 ? 'bg-accent' : 'bg-base-500' }}" style="height: {{ $h }}px"></span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Platforms --}}
    <section id="download" class="border-y border-base-600/60 bg-base-800">
        <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
            <h2 class="text-center text-sm font-semibold tracking-wide text-ink-500 uppercase">Runs where you do</h2>
            <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                @foreach ([
                    ['macOS', true],
                    ['iOS', true],
                    ['iPadOS', false],
                    ['Windows', false],
                    ['Linux', false],
                    ['Android', false],
                ] as [$platform, $available])
                    <div class="flex flex-col items-center gap-1 rounded-xl border border-base-600 bg-base-700 px-4 py-5">
                        <span class="font-semibold text-ink-100">{{ $platform }}</span>
                        @if ($available)
                            <a href="https://github.com/tripsittr/SoundChex/releases" class="text-sm font-medium text-accent transition-colors hover:text-accent-hot">Download</a>
                        @else
                            <span class="text-sm text-ink-500">Coming soon</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <p class="mt-4 text-center text-sm text-ink-500">
                The server runs anywhere PHP does. <a href="{{ route('docs') }}#install" class="text-ink-300 underline decoration-base-500 transition-colors hover:text-ink-100">Install guide →</a>
            </p>
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="mx-auto max-w-6xl px-4 py-20 sm:px-6">
        <h2 class="text-center text-3xl font-bold tracking-tight text-ink-100 sm:text-4xl">One library for everything you keep</h2>
        <p class="mx-auto mt-4 max-w-2xl text-center text-ink-300">
            Music, films, TV and books share a schema, a search box and a player. A song, an episode
            and a chapter are all things you were part-way through — and SoundChex treats them that way.
        </p>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['One catalogue, four media types', 'Music, films, TV and books in a single library with one search box and one player — resume anything, anywhere.'],
                ['Metadata that fills itself in', 'Nine sources asked in turn — TMDB, MusicBrainz, AcoustID, Open Library, iTunes, Spotify, OpenSubtitles and your files\' own tags. Every run is snapshotted and reversible.'],
                ['Search that reaches inside things', 'One query across titles, cast, film dialogue and the text of books. A dialogue hit jumps to the moment it is spoken; a book hit opens at the page.'],
                ['Reading and watching, not just listening', 'EPUB, PDF and CBZ with highlights, private notes and OCR. Video with hardware transcoding, caption tracks and skip markers.'],
                ['Works offline', 'The whole catalogue mirrors to your device, so browsing, search and playback of downloads work with no network at all. Downloads survive the app closing.'],
                ['Plays well with others', 'Files organised the way Plex, Jellyfin and Emby already read — Artist/Album, Title (Year), Series/Season 01 — so your library stays legible to anything else.'],
            ] as [$title, $body])
                <div class="rounded-xl border border-base-600 bg-base-700 p-6">
                    <h3 class="font-semibold text-ink-100">{{ $title }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink-300">{{ $body }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Profiles --}}
    <section class="border-y border-base-600/60 bg-base-800">
        <div class="mx-auto max-w-6xl px-4 py-16 text-center sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-ink-100 sm:text-3xl">A profile for every person in the house</h2>
            <p class="mx-auto mt-4 max-w-2xl text-ink-300">
                Per-person history, resume points and watchlists — and a kids mode that caps ratings
                across browsing, search and even direct links.
            </p>
        </div>
    </section>

    {{-- Pricing --}}
    <section id="pricing" class="mx-auto max-w-6xl px-4 py-20 sm:px-6">
        <h2 class="text-center text-3xl font-bold tracking-tight text-ink-100 sm:text-4xl">Free. Actually free.</h2>
        <p class="mx-auto mt-4 max-w-2xl text-center text-ink-300">
            Every feature, every platform, MIT-licensed. Pay only if you want us to handle the networking.
        </p>
        <div class="mx-auto mt-12 grid max-w-4xl gap-6 lg:grid-cols-2">
            <div class="rounded-2xl border border-base-600 bg-base-700 p-8">
                <h3 class="text-xl font-bold text-ink-100">Self-hosted</h3>
                <p class="mt-1 text-3xl font-extrabold text-ink-100">Free <span class="text-base font-medium text-ink-500">forever</span></p>
                <ul class="mt-6 space-y-3 text-sm text-ink-300">
                    <li class="flex gap-2"><span class="text-accent">✓</span> The whole app — no feature gates, ever</li>
                    <li class="flex gap-2"><span class="text-accent">✓</span> Remote access your way: Tailscale, reverse proxy, VPN, anything</li>
                    <li class="flex gap-2"><span class="text-accent">✓</span> MIT-licensed source on GitHub</li>
                </ul>
                <a href="#download" class="mt-8 inline-block rounded-lg border border-base-500 px-5 py-2.5 text-sm font-semibold text-ink-100 transition-colors hover:border-ink-500 hover:bg-base-600">Get started</a>
            </div>
            <div class="relative rounded-2xl border border-accent/40 bg-base-700 p-8">
                <span class="absolute -top-3 right-6 rounded-full bg-accent px-3 py-1 text-xs font-semibold text-white">Coming soon</span>
                <h3 class="text-xl font-bold text-ink-100">SCNet <span class="ml-1 text-sm font-medium text-ink-500">— the SoundChex Network</span></h3>
                <p class="mt-1 text-3xl font-extrabold text-ink-100">Subscription</p>
                <ul class="mt-6 space-y-3 text-sm text-ink-300">
                    <li class="flex gap-2"><span class="text-accent">✓</span> Everything in Self-hosted — the app never changes</li>
                    <li class="flex gap-2"><span class="text-accent">✓</span> Sign in from anywhere through our relay — no ports, no tunnels, no setup</li>
                    <li class="flex gap-2"><span class="text-accent">✓</span> Direct routes always preferred; the relay is the works-from-anywhere fallback</li>
                </ul>
                <div class="mt-8">
                    <livewire:scnet-waitlist />
                </div>
            </div>
        </div>
        <p class="mx-auto mt-6 max-w-2xl text-center text-sm text-ink-500">
            SCNet buys convenience, never capability. The app races every address it knows and takes
            the fastest that answers — a direct connection always wins when one exists.
        </p>
    </section>

    {{-- Open source + donations --}}
    <section id="donate" class="border-y border-base-600/60 bg-base-800">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
            <div class="grid items-center gap-10 lg:grid-cols-2">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-ink-100 sm:text-3xl">Open source, in the open</h2>
                    <p class="mt-4 text-ink-300">
                        MIT licensed. The code is public, the roadmap is public, the issues are public.
                        If SoundChex is useful to you, a donation keeps it free for everyone.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-4">
                        <a href="https://github.com/sponsors/tripsittr" class="rounded-lg bg-accent px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-accent-hot">Sponsor on GitHub</a>
                        <a href="https://github.com/tripsittr/SoundChex" class="rounded-lg border border-base-500 px-5 py-2.5 text-sm font-semibold text-ink-100 transition-colors hover:border-ink-500 hover:bg-base-700">Star the repo</a>
                    </div>
                </div>
                <div class="rounded-xl border border-base-600 bg-base-900 p-6 font-mono text-sm leading-relaxed text-ink-300">
                    <p class="mb-3 font-sans text-xs font-semibold tracking-wide text-ink-500 uppercase">Up and running in six lines</p>
                    <pre class="overflow-x-auto"><code>git clone https://github.com/tripsittr/SoundChex.git
cd SoundChex
composer install &amp;&amp; npm install
cp .env.example .env &amp;&amp; php artisan key:generate
php artisan migrate &amp;&amp; php artisan storage:link
npm run build &amp;&amp; php artisan serve</code></pre>
                    <p class="mt-3 font-sans text-sm">
                        <a href="{{ route('docs') }}#install" class="text-accent transition-colors hover:text-accent-hot">Full install guide →</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.site>
