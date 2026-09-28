<x-layouts.legal title="Accessibility — macOS" :legal="false" updated="September 28, 2026">
    <h1>Accessibility on macOS</h1>

    <p class="doc-lead">
        What the Mac app supports, what it does not, and how confident we are
        about each.
    </p>

    <h2>1. What the Mac app actually is</h2>
    <p>
        Unlike the iPhone app, the Mac app is not a separate piece of software
        with its own interface. It is a native window around the same web
        interface your browser shows, plus a menu bar and a page for connecting
        to your server.
    </p>
    <p>
        That matters here for one practical reason: <strong>almost everything
        described below is the web interface</strong>, so it behaves the same
        in Safari, Chrome or Firefox as it does in the app. If something works
        for you in a browser, it works in the app, and the reverse.
    </p>

    <h2>2. At a glance</h2>
    <table>
        <thead>
            <tr><th>Feature</th><th>Status</th></tr>
        </thead>
        <tbody>
            <tr><td>VoiceOver</td><td>Supported — not yet tested with VoiceOver running</td></tr>
            <tr><td>Keyboard only</td><td>Supported</td></tr>
            <tr><td>Larger Text</td><td>Browser zoom; no separate text-size setting</td></tr>
            <tr><td>Reduced Motion</td><td>Partial</td></tr>
            <tr><td>Differentiate Without Colour</td><td>Supported</td></tr>
            <tr><td>Sufficient Contrast</td><td>Supported — measured</td></tr>
            <tr><td>Dark Interface</td><td>Dark only</td></tr>
            <tr><td>Captions</td><td>Supported, where your file has them</td></tr>
            <tr><td>Audio Descriptions</td><td><strong>Not supported</strong></td></tr>
        </tbody>
    </table>

    <h2>3. VoiceOver and screen readers</h2>
    <p>
        The interface is built from real HTML controls — buttons are buttons,
        headings run in order, and every form field is tied to its label. That
        is most of what a screen reader needs, and it is why the interface
        works with assistive technology we have never tested against.
    </p>
    <p>
        The player announces its state: the seek bar reports your position and
        the track length as spoken durations and can be moved with the arrow
        keys, and when the queue moves to a new track it is announced rather
        than silently changing on screen. The menus behave as menus — arrow
        keys move between items, Escape closes and returns you to where you
        were.
    </p>
    <p>
        The status messages on the connect and server pages announce
        themselves, with errors interrupting rather than waiting their turn.
    </p>
    <p>
        <strong>What we have not done:</strong> used the app with VoiceOver
        running, start to finish. The semantics are correct as written and
        reviewed; nobody has sat down and driven it by ear.
    </p>

    <h2>4. Using it without a mouse</h2>
    <p>
        Every control is reachable by keyboard. There is a skip link to jump
        past the navigation, the seek bar takes arrow keys (shift for a minute,
        Home and End for the ends), menus take arrow keys, and dialogs keep
        focus inside them while open and return it to where you were when they
        close.
    </p>
    <p>
        The menu bar carries the usual shortcuts — ⌘R to refresh, ⌘1 and ⌘2 to
        move between the library and the admin panel.
    </p>

    <h2>5. Larger text</h2>
    <p>
        There is no text-size setting in the app. Use your browser's zoom —
        ⌘+ and ⌘− work in the Mac app as they do in a browser — which scales
        the whole interface. The layout is responsive, so it reflows rather
        than clipping.
    </p>
    <p>
        This is weaker than the iPhone app, which scales text independently of
        everything else. If zoom is not enough for you, please tell us.
    </p>

    <h2>6. Reduced Motion</h2>
    <p>
        <strong>Partial, and we would rather say so than round it up.</strong>
        The system setting is honoured for the artwork tiles that lift on
        hover and for the download spinner. Other transitions in the interface
        do not yet check it. None of them are large or looping, but "partial"
        is the accurate word.
    </p>

    <h2>7. Colour and contrast</h2>
    <p>
        Nothing is distinguished by colour alone: states that have a colour
        also have a symbol or a word. Every text colour against every surface
        it is used on has been measured against WCAG AA, and the dimmest
        combination in use is 5.28:1, against a requirement of 4.5:1.
    </p>
    <p>
        Where the accent colour is used for text rather than for a border or a
        fill, a lighter variant is used that clears 4.5:1 on every background
        it appears on.
    </p>

    <h2>8. Dark interface</h2>
    <p>
        The web interface is dark only — there is no light theme, and the app
        does not follow your system appearance. If you need a light interface,
        that is a real gap and we would like to know.
    </p>
    <p>
        The admin panel does have a light mode, following your system setting.
    </p>

    <h2>9. Captions</h2>
    <p>
        Subtitle tracks are listed and selectable in the video player, with an
        on-screen indicator when they are active. What is available depends on
        the file you own; the server can also fetch subtitles for items that
        have none.
    </p>

    <x-legal.accessibility-shared />
</x-layouts.legal>
