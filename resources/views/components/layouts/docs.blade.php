@props(['title', 'description' => 'SoundChex documentation — install, set up, integrate, configure and customize the free, self-hosted media library.'])
<x-layouts.site :title="$title . ' — SoundChex Docs'" :description="$description">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:grid lg:grid-cols-[230px_minmax(0,1fr)] lg:gap-12">
        <aside>
            {{-- Collapsed to a disclosure on phones, persistent rail on desktop. --}}
            <details class="group mb-8 rounded-xl border border-base-600 bg-base-800 lg:hidden">
                <summary class="cursor-pointer list-none px-4 py-3 text-sm font-semibold text-ink-100">
                    Documentation menu <span class="float-right text-ink-500 group-open:hidden">+</span><span class="float-right hidden text-ink-500 group-open:inline">−</span>
                </summary>
                <div class="border-t border-base-600 p-4">
                    <x-docs.sidebar />
                </div>
            </details>
            <div class="hidden lg:sticky lg:top-20 lg:block lg:max-h-[calc(100vh-6rem)] lg:overflow-y-auto lg:pb-8">
                <x-docs.sidebar />
            </div>
        </aside>
        <article class="doc-prose min-w-0">
            {{ $slot }}
        </article>
    </div>
</x-layouts.site>
