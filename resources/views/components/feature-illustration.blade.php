@props(['name'])

{{--
    Inlines an unDraw-style illustration SVG for the landing feature cards (S-267).

    unDraw illustrations (undraw.co, open licence, no attribution) use a single
    recolourable fill (#6C63FF). Drop the chosen `.svg` into
    `resources/illustrations/{name}.svg`; this inlines it and swaps that fill for
    the SoundChex accent via `currentColor`, so a `text-accent` parent controls
    the tint and it stays theme-aware. Nothing renders if the file is absent, so
    the layout degrades cleanly until the art is added.
--}}

@php
    $path = resource_path("illustrations/{$name}.svg");

    $svg = null;
    if (is_file($path)) {
        $raw = file_get_contents($path);

        // unDraw's recolourable fill → the SoundChex accent. Its default is
        // #6C63FF, but these were exported already tinted red (#F95454 with a
        // #FFB8B8 / #FAAFB2 light variant), so map every one to the accent so the
        // set matches the brand exactly rather than an off-red. The greys and
        // darks (#2F2E41, #3F3D56, #E6E6E6…) are left as the illustration's shading.
        $svg = str_ireplace(
            ['#6C63FF', '#F95454', '#FFB8B8', '#FAAFB2'],
            ['var(--sc-accent)', 'var(--sc-accent)', 'var(--sc-accent)', 'var(--sc-accent)'],
            $raw,
        );

        // Strip the fixed width/height so the class-driven size wins.
        $svg = preg_replace('/\s(width|height)="[^"]*"/i', '', $svg, 2) ?? $svg;
    }
@endphp

@if ($svg)
    <div {{ $attributes }} aria-hidden="true">
        {!! $svg !!}
    </div>
@endif
