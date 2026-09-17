<x-layouts.docs title="SoundChex on Windows">
    <h1>SoundChex on Windows</h1>
    <p><span class="inline-block rounded-full border border-base-500 bg-base-700 px-3 py-1 text-xs font-semibold text-ink-300">Coming soon — web app works today</span></p>
    <p class="doc-lead">
        The Windows desktop app hasn't shipped yet — the toolchain is documented and the
        Windows-specific fixes are written, but no build has been through real use, and we won't
        call it available until one has.
    </p>

    <h2>Using SoundChex on Windows now</h2>
    <ul>
        <li><strong>The web app</strong> — open <code>http://&lt;server-ip&gt;:8000/app</code> in Edge or Chrome and use <em>Install as app</em> from the browser menu. You get a windowed app with your artwork as the icon, full playback, and the whole interface.</li>
        <li><strong>The server</strong> runs on Windows today — see <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a>. A Windows machine can host the library for every other device in the house even before the desktop client ships.</li>
    </ul>

    <h2>Building the client yourself (adventurous)</h2>
    <p>
        The Tauri project targets Windows and the build is documented: Rust (MSVC toolchain), Visual
        Studio Build Tools with "Desktop development with C++", and WebView2 (present on Windows 11
        and most Windows 10). Then:
    </p>
    <pre><code>npm run build
npm run tauri:build       # produces .msi and .exe in src-tauri\target\release\bundle\</code></pre>
    <p>
        A first build compiles the whole Rust dependency tree and takes a while. If you get a
        working build, <a href="https://github.com/tripsittr/SoundChex/issues">say so on GitHub</a> —
        a confirmed Windows build is exactly what moves this page's badge to Available.
    </p>
</x-layouts.docs>
