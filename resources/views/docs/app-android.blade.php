<x-layouts.docs title="SoundChex on Android">
    <h1>SoundChex on Android</h1>
    <p><span class="inline-block rounded-full border border-base-500 bg-base-700 px-3 py-1 text-xs font-semibold text-ink-300">Planned — web app works today</span></p>
    <p class="doc-lead">
        Android is a target platform, and the honest status is: the native app work hasn't started
        yet. The web app carries Android well in the meantime.
    </p>

    <h2>Using SoundChex on Android now</h2>
    <ul>
        <li><strong>Install the web app</strong> — open your library in Chrome and use <em>Add to Home Screen</em>. SoundChex ships a web app manifest, so it installs like an app: full-screen, your artwork as the icon, the complete interface with playback, reading, profiles and search.</li>
        <li>For use away from home, set up <a href="{{ route('docs.show', 'remote-access') }}">remote access</a> — Tailscale's Android app pairs well with the Tailscale option.</li>
    </ul>

    <h2>Where the native app stands</h2>
    <p>
        Being upfront: no Tauri Android project has been generated yet, and the native shell will be
        real work beyond the build — Android's WebView is a different engine with different storage
        behaviour than iOS's, and offline storage is exactly the area being engineered carefully
        right now (see <a href="{{ route('docs.show', 'offline') }}">Offline &amp; downloads</a>).
        Rather than ship something that drops your downloads, Android waits its turn. Follow progress
        on <a href="https://github.com/tripsittr/SoundChex">GitHub</a>.
    </p>
</x-layouts.docs>
