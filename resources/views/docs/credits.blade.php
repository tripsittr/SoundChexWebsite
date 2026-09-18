{{-- SPDX-License-Identifier: AGPL-3.0-or-later --}}
{{-- Copyright (C) 2026 SoundChex --}}
@php
    $data = json_decode(file_get_contents(resource_path('data/credits.json')), true);
    $total = collect($data['ecosystems'])->sum(fn ($e) => count($e['packages']));

    // Curated marquee — the ecosystems and frameworks SoundChex leans on most.
    // Brand colour + a short label; a monogram tile, self-hosted (no external
    // requests). Not every package has a logo, so the long tail below is
    // credited by name + licence + link.
    $marquee = [
        ['Laravel', '#FF2D20', 'La', 'PHP framework', 'https://laravel.com'],
        ['PHP', '#777BB4', 'php', 'The language', 'https://php.net'],
        ['Filament', '#FDAE4B', 'Fi', 'Admin panels', 'https://filamentphp.com'],
        ['Livewire', '#FB70A9', 'Lw', 'Reactive UI', 'https://livewire.laravel.com'],
        ['Tailwind CSS', '#38BDF8', 'Tw', 'Styling', 'https://tailwindcss.com'],
        ['Vite', '#646CFF', 'Vt', 'Build tool', 'https://vitejs.dev'],
        ['Alpine.js', '#77C1D2', 'Aj', 'Interactivity', 'https://alpinejs.dev'],
        ['Tauri', '#FFC131', 'Ta', 'Desktop shell', 'https://tauri.app'],
        ['Rust', '#DEA584', 'Rs', 'Systems language', 'https://rust-lang.org'],
        ['getID3', '#4B9CD3', 'id3', 'Media tags', 'https://github.com/JamesHeinrich/getID3'],
        ['Symfony', '#000000', 'Sy', 'PHP components', 'https://symfony.com'],
        ['SQLite', '#003B57', 'Sq', 'Database', 'https://sqlite.org'],
    ];
@endphp

<x-layouts.docs title="Open-source credits">
    <h1>Open-source credits</h1>
    <p class="doc-lead">
        SoundChex stands on the work of hundreds of open-source projects and the people and companies
        who build them. This page credits every third-party dependency we ship — {{ number_format($total) }}
        packages across PHP, JavaScript and Rust — with its licence. Thank you to everyone whose work
        is listed here.
    </p>

    <h2>Built on</h2>
    <p>A few of the projects SoundChex leans on most:</p>
    <div class="not-prose my-6 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
        @foreach ($marquee as [$name, $color, $mono, $role, $url])
            <a href="{{ $url }}" target="_blank" rel="noopener"
               class="flex items-center gap-3 rounded-xl border border-base-600 bg-base-800/60 p-3 transition hover:border-base-500 hover:bg-base-700">
                <span class="flex size-11 shrink-0 items-center justify-center rounded-lg text-sm font-bold text-white"
                      style="background: {{ $color }}">{{ $mono }}</span>
                <span class="min-w-0">
                    <span class="block truncate text-sm font-semibold text-ink-100">{{ $name }}</span>
                    <span class="block truncate text-xs text-ink-500">{{ $role }}</span>
                </span>
            </a>
        @endforeach
    </div>

    <h2>Every dependency</h2>
    <p>
        The complete list, grouped by ecosystem. Each is credited by name, version and licence, and
        links to its home. Every licence here is compatible with SoundChex's own
        <a href="{{ route('legal.show', 'website-terms') }}">AGPLv3</a> licence.
    </p>

    @foreach ($data['ecosystems'] as $eco)
        <details class="not-prose my-4 rounded-xl border border-base-700 bg-base-800/40" @if ($loop->first) open @endif>
            <summary class="cursor-pointer list-none px-4 py-3 font-semibold text-ink-100">
                <span class="inline-flex items-center gap-2">
                    <svg class="size-4 text-ink-500 transition-transform [details[open]_&]:rotate-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    {{ $eco['name'] }}
                    <span class="rounded-full border border-base-600 px-2 py-0.5 text-xs font-normal text-ink-400">{{ count($eco['packages']) }}</span>
                </span>
            </summary>
            <div class="overflow-x-auto border-t border-base-700">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wide text-ink-500">
                            <th class="px-4 py-2 font-medium">Package</th>
                            <th class="px-4 py-2 font-medium">Version</th>
                            <th class="px-4 py-2 font-medium">Licence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eco['packages'] as $pkg)
                            @php
                                $license = implode(', ', $pkg['license'] ?: ['—']);
                                $link = str_contains($eco['name'], 'Composer')
                                    ? 'https://packagist.org/packages/' . $pkg['name']
                                    : (str_contains($eco['name'], 'npm')
                                        ? 'https://www.npmjs.com/package/' . $pkg['name']
                                        : 'https://crates.io/crates/' . $pkg['name']);
                            @endphp
                            <tr class="border-t border-base-700/50 align-top">
                                <td class="px-4 py-2">
                                    <a href="{{ $link }}" target="_blank" rel="noopener"
                                       class="font-medium text-ink-200 hover:text-accent">{{ $pkg['name'] }}</a>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-ink-500">{{ $pkg['version'] }}</td>
                                <td class="px-4 py-2 text-ink-400">{{ $license }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </details>
    @endforeach

    <div class="doc-note">
        <p><strong>Regenerating this list.</strong> The data is
        <code>resources/data/credits.json</code>, produced from the app repo's dependency manifests
        (<code>composer licenses</code>, npm package metadata, <code>cargo metadata</code>). See
        <code>Documentation &amp; Planning/LicenseAudit.md</code> in the app repo for the audit and the
        commands.</p>
    </div>
</x-layouts.docs>
