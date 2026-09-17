<x-layouts.site title="Legal — SoundChex" description="SoundChex legal documents — terms, privacy and cookie policies for the website, the server and each app.">
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100">Legal</h1>
        <p class="mt-4 max-w-2xl text-ink-300">
            One document per thing, so each can be specific. The standing principle behind all of
            them: <strong class="text-ink-100">zero trackers, zero data collection.</strong> Outside
            SCNet, we hold no user data at all; inside SCNet, only what the service legally and
            functionally requires.
        </p>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-xl border border-base-600 bg-base-700 p-6">
                <h2 class="font-bold text-ink-100">This website</h2>
                <p class="mt-2 text-sm text-ink-300">soundchex.com — the pages you're reading now.</p>
                <ul class="mt-4 space-y-1.5 text-sm">
                    <li><a href="{{ route('legal.show', 'website-terms') }}" class="text-accent hover:text-accent-hot">Terms of Use →</a></li>
                    <li><a href="{{ route('legal.show', 'website-privacy') }}" class="text-accent hover:text-accent-hot">Privacy Policy →</a></li>
                    <li><a href="{{ route('legal.show', 'cookies') }}" class="text-accent hover:text-accent-hot">Cookie Policy →</a></li>
                </ul>
            </div>
            <div class="rounded-xl border border-base-600 bg-base-700 p-6">
                <h2 class="font-bold text-ink-100">SoundChex Server</h2>
                <p class="mt-2 text-sm text-ink-300">The software that hosts your library, on your machine.</p>
                <ul class="mt-4 space-y-1.5 text-sm">
                    <li><a href="{{ route('legal.show', 'server-terms') }}" class="text-accent hover:text-accent-hot">Server Terms →</a></li>
                    <li><a href="{{ route('legal.show', 'server-privacy') }}" class="text-accent hover:text-accent-hot">Server Privacy →</a></li>
                </ul>
            </div>
            <div class="rounded-xl border border-base-600 bg-base-700 p-6">
                <h2 class="font-bold text-ink-100">SCNet</h2>
                <p class="mt-2 text-sm text-ink-300">The SoundChex Network — the optional hosted relay subscription.</p>
                <p class="mt-4 text-sm text-ink-500">Subscriber terms and a dedicated privacy notice will be published here before SCNet takes its first subscriber. Nothing is collected from the waitlist beyond the email you give it.</p>
            </div>
            @foreach ([
                'macos' => 'macOS',
                'windows' => 'Windows',
                'linux' => 'Linux',
                'ios' => 'iOS',
                'ipados' => 'iPadOS',
                'android' => 'Android',
            ] as $slug => $platform)
                <div class="rounded-xl border border-base-600 bg-base-700 p-6">
                    <h2 class="font-bold text-ink-100">SoundChex for {{ $platform }}</h2>
                    <p class="mt-2 text-sm text-ink-300">The {{ $platform }} app.</p>
                    <ul class="mt-4 space-y-1.5 text-sm">
                        <li><a href="{{ route('legal.show', $slug.'-terms') }}" class="text-accent hover:text-accent-hot">Terms →</a></li>
                        <li><a href="{{ route('legal.show', $slug.'-privacy') }}" class="text-accent hover:text-accent-hot">Privacy →</a></li>
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.site>
