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
        // unDraw's recolourable purple → currentColor; strip a fixed width/height
        // so the class-driven size wins.
        $svg = str_ireplace(['#6C63FF', '#6c63ff'], 'currentColor', $raw);
        $svg = preg_replace('/\s(width|height)="[^"]*"/i', '', $svg, 2) ?? $svg;
    }
@endphp

@if ($svg)
    <div {{ $attributes->merge(['class' => 'text-accent']) }} aria-hidden="true">
        {!! $svg !!}
    </div>
@endif
