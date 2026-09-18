{{-- SPDX-License-Identifier: AGPL-3.0-or-later --}}
{{-- Copyright (C) 2026 SoundChex --}}
<x-layouts.site
    title="Changelog — SoundChex"
    description="What's new in SoundChex — releases and notable updates across the server, apps and network.">

    <section class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-ink-100 sm:text-5xl">Changelog</h1>
        <p class="mt-4 max-w-2xl text-ink-300">
            What's new in SoundChex — releases and notable updates. For the full
            commit-level history, see each project's
            <a href="https://github.com/tripsittr" class="text-accent hover:text-accent-hot">GitHub repository</a>.
        </p>

        @php
            $notes = rescue(fn () => \App\Models\ReleaseNote::published(), collect(), false);
            $platforms = \App\Models\Item::PLATFORMS;
        @endphp

        @if ($notes->isEmpty())
            <p class="mt-12 rounded-xl border border-base-700 bg-base-800/50 p-6 text-center text-ink-500">
                No release notes yet — check back soon.
            </p>
        @else
            {{-- A vertical timeline: each release a node on the line. --}}
            <div class="relative mt-12">
                <span class="pointer-events-none absolute left-2 top-2 hidden h-full w-px bg-base-700 sm:block"></span>

                <div class="space-y-10">
                    @foreach ($notes as $note)
                        <article class="relative sm:pl-10">
                            <span class="pointer-events-none absolute left-0 top-2 hidden size-4 -translate-x-1/2 rounded-full border-2 border-base-900 bg-accent ring-4 ring-base-900 sm:block"></span>

                            <div class="flex flex-wrap items-center gap-2">
                                @if ($note->version)
                                    <span class="rounded-full bg-accent/15 px-2.5 py-0.5 text-sm font-semibold text-accent">{{ $note->version }}</span>
                                @endif
                                <h2 class="text-xl font-bold text-ink-100">{{ $note->title }}</h2>
                            </div>

                            <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-ink-500">
                                @if ($note->released_on)
                                    <time datetime="{{ $note->released_on->toDateString() }}">{{ $note->released_on->format('F j, Y') }}</time>
                                @endif
                                @if ($note->platform)
                                    <span class="rounded-full border border-base-600 px-2 py-0.5 text-xs text-ink-400">{{ $platforms[$note->platform] ?? $note->platform }}</span>
                                @endif
                            </div>

                            <div class="prose-changelog mt-4 text-ink-300">
                                {!! \Illuminate\Support\Str::markdown($note->body) !!}
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</x-layouts.site>
