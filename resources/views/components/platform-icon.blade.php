@props(['name'])

{{--
    Monochrome platform glyphs for the "Runs where you do" strip (S-267).

    currentColor so the tile controls the tint; matched by the platform name the
    Platforms model stores. A generic device glyph covers anything unmapped, so a
    new platform never renders blank.
--}}

@php
    $key = \Illuminate\Support\Str::lower(trim($name));

    $svgAttributes = $attributes->merge([
        'viewBox' => '0 0 24 24',
        'fill' => 'currentColor',
        'aria-hidden' => 'true',
    ]);
@endphp

<svg {{ $svgAttributes }}>
    @switch(true)
        @case(str_contains($key, 'ios') || str_contains($key, 'ipad') || str_contains($key, 'mac') || str_contains($key, 'apple') || str_contains($key, 'tvos'))
            {{-- Apple --}}
            <path d="M16.365 1.43c0 1.14-.417 2.2-1.114 2.98-.837.94-2.2 1.66-3.34 1.57-.14-1.11.43-2.29 1.11-3.02.75-.81 2.09-1.46 3.34-1.53zM20.9 17.14c-.62 1.43-.92 2.07-1.72 3.34-1.12 1.77-2.7 3.97-4.66 3.98-1.74.02-2.19-1.14-4.55-1.13-2.36.01-2.85 1.15-4.59 1.13-1.96-.02-3.46-2.01-4.58-3.78C-.32 17.3-.62 12.3 1.58 9.55c1.03-1.29 2.65-2.11 4.22-2.11 1.6 0 2.6 1.14 3.92 1.14 1.28 0 2.06-1.14 3.91-1.14 1.4 0 2.88.76 3.93 2.08-3.45 1.89-2.89 6.81.34 8.56z" />
            @break

        @case(str_contains($key, 'android'))
            {{-- Android --}}
            <path d="M17.6 9.48l1.84-3.18a.4.4 0 0 0-.7-.4l-1.87 3.22a11.6 11.6 0 0 0-9.74 0L5.26 5.9a.4.4 0 1 0-.7.4L6.4 9.48A11 11 0 0 0 1 18.5h22a11 11 0 0 0-5.4-9.02zM7 15.25a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm10 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            @break

        @case(str_contains($key, 'windows'))
            {{-- Windows --}}
            <path d="M3 5.6l7.5-1.03v7.24H3zM11.3 4.45L21 3v9.1h-9.7zM3 12.62h7.5v7.24L3 18.82zM11.3 12.62H21V21l-9.7-1.35z" />
            @break

        @case(str_contains($key, 'linux'))
            {{-- Tux (simplified) --}}
            <path d="M12 2c-2.2 0-3.6 1.9-3.6 4.2 0 1.2.3 2.1.3 3-.5.9-2 3-2.8 4.6-.6 1.2-1.5 2.4-1.5 3.6 0 .8.6 1.3 1.4 1.1.5.9 1.6 1.5 2.8 1.5h6.8c1.2 0 2.3-.6 2.8-1.5.8.2 1.4-.3 1.4-1.1 0-1.2-.9-2.4-1.5-3.6-.8-1.6-2.3-3.7-2.8-4.6 0-.9.3-1.8.3-3C15.6 3.9 14.2 2 12 2zm-1.4 4.3a.7.7 0 1 1 0 1.4.7.7 0 0 1 0-1.4zm2.8 0a.7.7 0 1 1 0 1.4.7.7 0 0 1 0-1.4zM12 8.4c1 0 2 .7 2 1.3 0 .3-.9.9-2 .9s-2-.6-2-.9c0-.6 1-1.3 2-1.3z" />
            @break

        @default
            {{-- Generic device --}}
            <path d="M4 4h16a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-6l1 2h2v1H7v-1h2l1-2H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm0 2v9h16V6z" />
    @endswitch
</svg>
