<x-layouts.docs title="SoundChex on iPadOS">
    <h1>SoundChex on iPadOS</h1>
    <p><span class="inline-block rounded-full border border-base-500 bg-base-700 px-3 py-1 text-xs font-semibold text-ink-300">Planned — web app works today</span></p>
    <p class="doc-lead">
        A dedicated iPad experience is on the roadmap. Today the iPad is already well served two ways.
    </p>

    <h2>Using SoundChex on an iPad now</h2>
    <ul>
        <li><strong>The web app</strong> — open your library in Safari and use <em>Add to Home Screen</em>. Full interface, full playback, reading with highlights and notes; the bigger canvas suits the book reader especially well.</li>
        <li><strong>The iOS build</strong> — the <a href="{{ route('docs.show', 'app-ios') }}">iPhone app</a> installs and runs on iPad.</li>
    </ul>

    <h2>What "dedicated" will mean</h2>
    <p>
        The interface is served by the server and already adapts to the screen; the iPad work is
        about the shell — offline storage sized for an iPad's role as the reading-and-watching
        device, and layout affordances beyond a scaled-up phone app. Follow progress on
        <a href="https://github.com/tripsittr/SoundChex">GitHub</a>.
    </p>

    <h2>In the meantime</h2>
    <p>
        Everything in <a href="{{ route('docs.show', 'profiles') }}">Profiles &amp; kids mode</a>,
        <a href="{{ route('docs.show', 'search') }}">Search</a> and
        <a href="{{ route('docs.show', 'remote-access') }}">Remote access</a> applies to the iPad
        exactly as to any other device.
    </p>
</x-layouts.docs>
