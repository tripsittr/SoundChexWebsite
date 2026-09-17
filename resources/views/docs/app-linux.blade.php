<x-layouts.docs title="SoundChex on Linux">
    <h1>SoundChex on Linux</h1>
    <p><span class="inline-block rounded-full border border-base-500 bg-base-700 px-3 py-1 text-xs font-semibold text-ink-300">Coming soon — web app works today</span></p>
    <p class="doc-lead">
        The Linux desktop app hasn't shipped yet. The build is documented and produces
        <code>.deb</code>, <code>.rpm</code> and <code>.AppImage</code> — but it hasn't been through
        real use, and the badge stays honest until it has.
    </p>

    <h2>Using SoundChex on Linux now</h2>
    <ul>
        <li><strong>The web app</strong> — open <code>http://&lt;server-ip&gt;:8000/app</code> in any browser; Chromium-based browsers offer <em>Install as app</em> for a windowed experience.</li>
        <li><strong>The server</strong> is at home on Linux — an always-on box or home server is the natural host. See <a href="{{ route('docs.show', 'server-linux') }}">Install on Linux</a>.</li>
    </ul>

    <h2>Building the client yourself</h2>
    <pre><code>sudo apt install libwebkit2gtk-4.1-dev build-essential curl wget file \
  libxdo-dev libssl-dev libayatana-appindicator3-dev librsvg2-dev
curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh

npm run build
npm run tauri:build       # .deb, .rpm, .AppImage</code></pre>
    <p>
        Built one and used it for a week? <a href="https://github.com/tripsittr/SoundChex/issues">Tell
        us on GitHub</a> — real-world confirmation is what ships prebuilt packages.
    </p>
</x-layouts.docs>
