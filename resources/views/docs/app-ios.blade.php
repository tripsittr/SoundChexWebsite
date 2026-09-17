<x-layouts.docs title="SoundChex on iOS">
    <h1>SoundChex on iOS</h1>
    <p><span class="inline-block rounded-full bg-accent px-3 py-1 text-xs font-semibold text-white">Available</span></p>
    <p class="doc-lead">
        The iPhone app is built and runs on device. It isn't on the App Store yet — today it installs
        as a developer build, and the web app covers everyone else beautifully in the meantime.
    </p>

    <h2>The app</h2>
    <p>
        Enter your server's address on the connect screen — LAN, tailnet or tunnel. The interface is
        served by your server, so the app stays current without App Store updates. The app races
        every address it knows and re-checks on wake, so leaving the house switches routes
        automatically (see <a href="{{ route('docs.show', 'remote-access') }}">Remote access</a>).
    </p>
    <p>
        Downloads are stored natively on the device, so downloaded music, films and books play with
        no network at all — including after a full app close. The catalogue itself mirrors to the
        phone (a fraction of a megabyte gzipped), so browsing and search also work offline. See
        <a href="{{ route('docs.show', 'offline') }}">Offline &amp; downloads</a> for what to expect.
    </p>

    <h2>Installing it today</h2>
    <ul>
        <li><strong>Developer build</strong> — build from source with a paid Apple developer account (a free account's profile expires after seven days): <code>npm run tauri ios build</code>. App Store / TestFlight distribution is on the roadmap.</li>
        <li><strong>The web app</strong> — open your library in Safari and use <em>Add to Home Screen</em>. SoundChex ships a web app manifest, so it launches full-screen with your artwork as the icon. This is a genuinely good experience, not a consolation prize — it's the same interface.</li>
    </ul>

    <h2>Good to know</h2>
    <ul>
        <li>Profiles and kids mode work exactly as everywhere else — the rating cap holds across browsing, search and direct links.</li>
        <li>For playback away from home you'll want <a href="{{ route('docs.show', 'remote-access') }}">remote access</a> configured, or downloads made while on Wi-Fi.</li>
    </ul>
</x-layouts.docs>
