@props(['title', 'updated' => 'September 17, 2026'])
<x-layouts.site :title="$title . ' — SoundChex Legal'" description="SoundChex legal documents — terms, privacy and cookie policies for the website, the server and each app.">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:grid lg:grid-cols-[230px_minmax(0,1fr)] lg:gap-12">
        <aside>
            <details class="group mb-8 rounded-xl border border-base-600 bg-base-800 lg:hidden">
                <summary class="cursor-pointer list-none px-4 py-3 text-sm font-semibold text-ink-100">
                    Legal menu <span class="float-right text-ink-500 group-open:hidden">+</span><span class="float-right hidden text-ink-500 group-open:inline">−</span>
                </summary>
                <div class="border-t border-base-600 p-4">
                    <x-legal.sidebar />
                </div>
            </details>
            <div class="hidden lg:sticky lg:top-20 lg:block lg:max-h-[calc(100vh-6rem)] lg:overflow-y-auto lg:pb-8">
                <x-legal.sidebar />
            </div>
        </aside>
        <article class="doc-prose min-w-0">
            <p class="mb-4 text-xs font-semibold tracking-wide text-ink-500 uppercase">Effective {{ $updated }} · Operated by Tripsittr LLC · <span class="text-accent">Draft pending legal review</span></p>
            {{ $slot }}
        </article>
    </div>
</x-layouts.site>
