@php
    $sections = [
        'This website' => [
            'website-terms' => 'Terms of Use',
            'website-privacy' => 'Privacy Policy',
            'cookies' => 'Cookie Policy',
        ],
        'SoundChex Server' => [
            'server-terms' => 'Server Terms',
            'server-privacy' => 'Server Privacy',
        ],
        'The apps' => [
            'macos-terms' => 'macOS — Terms',
            'macos-privacy' => 'macOS — Privacy',
            'windows-terms' => 'Windows — Terms',
            'windows-privacy' => 'Windows — Privacy',
            'linux-terms' => 'Linux — Terms',
            'linux-privacy' => 'Linux — Privacy',
            'ios-terms' => 'iOS — Terms',
            'ios-privacy' => 'iOS — Privacy',
            'ipados-terms' => 'iPadOS — Terms',
            'ipados-privacy' => 'iPadOS — Privacy',
            'android-terms' => 'Android — Terms',
            'android-privacy' => 'Android — Privacy',
        ],
    ];
    $current = request()->route('slug');
@endphp

<nav class="text-sm" aria-label="Legal">
    <a href="{{ route('legal') }}" class="mb-4 block font-semibold {{ $current === null ? 'text-accent' : 'text-ink-100 hover:text-accent' }}">
        Legal home
    </a>
    <div class="space-y-6">
        @foreach ($sections as $label => $links)
            <div>
                <p class="mb-2 text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $label }}</p>
                <ul class="space-y-1 border-l border-base-600">
                    @foreach ($links as $slug => $title)
                        <li>
                            <a
                                href="{{ route('legal.show', $slug) }}"
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
        <p class="text-xs text-ink-500">SCNet subscriber terms and privacy will be published here before the service opens.</p>
    </div>
</nav>
