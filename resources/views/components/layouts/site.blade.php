@props(['title' => 'SoundChex — your media, your machine, every device', 'description' => 'SoundChex is a free, open-source, self-hosted library for your music, films, TV and books — one catalogue, one player, on every device you own.'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scheme-dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/app-icon.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/app-icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-900 font-sans text-ink-300 antialiased">
    <header class="sticky top-0 z-40 border-b border-base-600/60 bg-base-900/80 backdrop-blur">
        <nav class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-4 py-3 sm:px-6">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo-light-on-dark-trim.png') }}" alt="SoundChex" class="h-10 w-auto">
            </a>
            <div class="flex items-center gap-4 text-sm font-medium sm:gap-6">
                <a href="{{ route('home') }}#features" class="hidden text-ink-300 transition-colors hover:text-ink-100 sm:inline">Features</a>
                <a href="{{ route('home') }}#pricing" class="hidden text-ink-300 transition-colors hover:text-ink-100 sm:inline">Pricing</a>
                <a href="{{ route('roadmap') }}" class="hidden text-ink-300 transition-colors hover:text-ink-100 sm:inline">Roadmap</a>
                <a href="{{ route('changelog') }}" class="hidden text-ink-300 transition-colors hover:text-ink-100 lg:inline">Changelog</a>
                <a href="{{ route('docs') }}" class="text-ink-300 transition-colors hover:text-ink-100">Docs</a>
                <a href="https://github.com/tripsittr/SoundChex" class="text-ink-300 transition-colors hover:text-ink-100">GitHub</a>
                <a href="{{ route('download') }}" class="rounded-lg bg-accent px-4 py-2 font-semibold text-white transition-colors hover:bg-accent-hot">Download</a>
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="border-t border-base-600/60 bg-base-800">
        <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                <div class="space-y-3">
                    <img src="{{ asset('images/logo-light-on-dark-trim.png') }}" alt="SoundChex" class="h-14 w-auto">
                    <p class="text-sm text-ink-500">Your media. Your machine. Every device.</p>
                </div>
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-ink-100">Product</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}#features" class="transition-colors hover:text-ink-100">Features</a></li>
                        <li><a href="{{ route('home') }}#pricing" class="transition-colors hover:text-ink-100">Pricing &amp; SCNet</a></li>
                        <li><a href="{{ route('roadmap') }}" class="transition-colors hover:text-ink-100">Roadmap</a></li>
                        <li><a href="{{ route('changelog') }}" class="transition-colors hover:text-ink-100">Changelog</a></li>
                        <li><a href="{{ route('download') }}" class="transition-colors hover:text-ink-100">Download</a></li>
                        <li><a href="{{ route('home') }}#donate" class="transition-colors hover:text-ink-100">Donate</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-ink-100">Documentation</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('docs.show', 'quick-start') }}" class="transition-colors hover:text-ink-100">Quick start</a></li>
                        <li><a href="{{ route('docs.show', 'server-macos') }}" class="transition-colors hover:text-ink-100">Install the server</a></li>
                        <li><a href="{{ route('docs.show', 'metadata') }}" class="transition-colors hover:text-ink-100">Integrations</a></li>
                        <li><a href="{{ route('docs.show', 'remote-access') }}" class="transition-colors hover:text-ink-100">Remote access</a></li>
                        <li><a href="{{ route('docs.show', 'troubleshooting') }}" class="transition-colors hover:text-ink-100">Troubleshooting</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-ink-100">Project</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://github.com/tripsittr/SoundChex" class="transition-colors hover:text-ink-100">Source on GitHub</a></li>
                        <li><a href="https://github.com/tripsittr/SoundChex/issues" class="transition-colors hover:text-ink-100">Issues &amp; support</a></li>
                        <li><a href="{{ route('legal.show', 'website-privacy') }}" class="transition-colors hover:text-ink-100">Privacy</a></li>
                        <li><a href="{{ route('legal.show', 'website-terms') }}" class="transition-colors hover:text-ink-100">Terms</a></li>
                        <li><a href="{{ route('legal.show', 'cookies') }}" class="transition-colors hover:text-ink-100">Cookies</a></li>
                        <li><a href="{{ route('legal') }}" class="transition-colors hover:text-ink-100">All legal</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 border-t border-base-600/60 pt-6 text-xs text-ink-500">
                <p class="max-w-2xl">
                    SoundChex is AGPLv3-licensed. Your media is not ours and not our business — SoundChex is a
                    library for files you already have; it neither acquires them nor helps you to.
                </p>
                <p class="mt-3">&copy; {{ date('Y') }} Tripsittr LLC. SoundChex&trade; is a trademark of Tripsittr LLC.</p>
            </div>
        </div>
    </footer>
</body>
</html>
