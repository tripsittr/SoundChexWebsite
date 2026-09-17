@php
    // The docs tree. Adding a page: create resources/views/docs/<slug>.blade.php,
    // list it here, and it is routed, navigable and tested automatically.
    $sections = [
        'Getting started' => [
            'introduction' => 'Introduction',
            'quick-start' => 'Quick start',
            'requirements' => 'Requirements',
        ],
        'Server' => [
            'server-macos' => 'Install on macOS',
            'server-windows' => 'Install on Windows',
            'server-linux' => 'Install on Linux',
            'libraries' => 'Libraries & scanning',
            'metadata' => 'Metadata & integrations',
            'workers' => 'Background workers',
            'remote-access' => 'Remote access',
            'moving-a-server' => 'Moving & backups',
        ],
        'Apps' => [
            'app-macos' => 'macOS',
            'app-windows' => 'Windows',
            'app-linux' => 'Linux',
            'app-ios' => 'iOS',
            'app-ipados' => 'iPadOS',
            'app-android' => 'Android',
        ],
        'Using SoundChex' => [
            'profiles' => 'Profiles & kids mode',
            'search' => 'Search',
            'offline' => 'Offline & downloads',
            'customization' => 'Customization',
        ],
        'Help' => [
            'troubleshooting' => 'Troubleshooting',
        ],
    ];
    $current = request()->route('slug');
@endphp

<nav class="text-sm" aria-label="Documentation">
    <a href="{{ route('docs') }}" class="mb-4 block font-semibold {{ $current === null ? 'text-accent' : 'text-ink-100 hover:text-accent' }}">
        Documentation home
    </a>
    <div class="space-y-6">
        @foreach ($sections as $label => $links)
            <div>
                <p class="mb-2 text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $label }}</p>
                <ul class="space-y-1 border-l border-base-600">
                    @foreach ($links as $slug => $title)
                        <li>
                            <a
                                href="{{ route('docs.show', $slug) }}"
                                @if ($current === $slug) aria-current="page" @endif
                                class="-ml-px block border-l py-1 pl-3 transition-colors {{ $current === $slug
                                    ? 'border-accent font-medium text-accent'
                                    : 'border-transparent text-ink-300 hover:border-ink-500 hover:text-ink-100' }}"
                            >{{ $title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</nav>
