<x-layouts.site title="Documentation — SoundChex" description="Install, set up, integrate, configure and customize SoundChex — the free, self-hosted media library.">
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100">Documentation</h1>
        <p class="mt-4 max-w-2xl text-ink-300">
            Everything from a fresh install to remote access from anywhere. If a page doesn't answer
            your question, <a href="https://github.com/tripsittr/SoundChex/issues" class="text-accent hover:text-accent-hot">open an issue on GitHub</a> —
            that's the support channel, and it improves the docs for the next person.
        </p>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                [
                    'Getting started',
                    'What SoundChex is, and from zero to playing in one sitting.',
                    ['introduction' => 'Introduction', 'quick-start' => 'Quick start', 'requirements' => 'Requirements', 'github-setup' => 'GitHub & source setup'],
                ],
                [
                    'Server',
                    'Installing and running the server on each operating system.',
                    ['server-macos' => 'Install on macOS', 'server-windows' => 'Install on Windows', 'server-linux' => 'Install on Linux', 'workers' => 'Background workers'],
                ],
                [
                    'Your library',
                    'Watch folders, scanning, metadata and how files are organised.',
                    ['libraries' => 'Libraries & scanning', 'metadata' => 'Metadata & integrations', 'customization' => 'Customization'],
                ],
                [
                    'Apps — every device',
                    'Installers, first-launch setup, and the app on each platform.',
                    ['dmg-setup' => 'macOS setup (.dmg)', 'exe-setup' => 'Windows setup (.exe)', 'app-macos' => 'macOS', 'app-windows' => 'Windows', 'app-linux' => 'Linux', 'app-ios' => 'iOS', 'app-ipados' => 'iPadOS', 'app-android' => 'Android'],
                ],
                [
                    'Away from home',
                    'Remote access options, and moving a whole server between machines.',
                    ['remote-access' => 'Remote access', 'moving-a-server' => 'Moving & backups', 'offline' => 'Offline & downloads'],
                ],
                [
                    'People & help',
                    'Profiles, kids mode, search — and what to check when something breaks.',
                    ['profiles' => 'Profiles & kids mode', 'search' => 'Search', 'troubleshooting' => 'Troubleshooting'],
                ],
                [
                    'About',
                    'The open-source projects SoundChex is built on, and the people who made them.',
                    ['credits' => 'Open-source credits'],
                ],
            ] as [$title, $blurb, $links])
                <div class="rounded-xl border border-base-600 bg-base-700 p-6">
                    <h2 class="font-bold text-ink-100">{{ $title }}</h2>
                    <p class="mt-2 text-sm text-ink-300">{{ $blurb }}</p>
                    <ul class="mt-4 space-y-1.5 text-sm">
                        @foreach ($links as $slug => $label)
                            <li><a href="{{ route('docs.show', $slug) }}" class="text-accent transition-colors hover:text-accent-hot">{{ $label }} →</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.site>
