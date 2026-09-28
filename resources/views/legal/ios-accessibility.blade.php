<x-layouts.legal title="Accessibility — iPhone" :legal="false" updated="September 28, 2026">
    <h1>Accessibility on iPhone</h1>

    <p class="doc-lead">
        What the iPhone app supports, what it does not, and how confident we
        are about each. Apple publishes nine accessibility features an app can
        declare; this page goes through all nine and says plainly where we
        stand.
    </p>

    <h2>1. At a glance</h2>
    <table>
        <thead>
            <tr><th>Feature</th><th>Status</th></tr>
        </thead>
        <tbody>
            <tr><td>VoiceOver</td><td>Supported — not yet tested with the screen curtain</td></tr>
            <tr><td>Voice Control</td><td>Supported through the same labels — not separately tested</td></tr>
            <tr><td>Larger Text (Dynamic Type)</td><td>Supported — tested on device</td></tr>
            <tr><td>Reduced Motion</td><td>Supported — tested on device</td></tr>
            <tr><td>Differentiate Without Colour</td><td>Supported</td></tr>
            <tr><td>Sufficient Contrast</td><td>Supported — measured</td></tr>
            <tr><td>Dark Interface</td><td>Supported</td></tr>
            <tr><td>Captions</td><td>Supported, where your file has them</td></tr>
            <tr><td>Audio Descriptions</td><td><strong>Not supported</strong></td></tr>
        </tbody>
    </table>

    <h2>2. VoiceOver</h2>
    <p>
        Every control the app draws carries a name. Rows — a search result, a
        download, an episode, a cast member — are read as one sentence rather
        than as separate fragments of artwork and text.
    </p>
    <p>
        State that is shown only by colour is spoken. A dimmed row that cannot
        play offline says why. A downloaded item says it is downloaded. An
        expired download says it has expired, and when one is going to expire
        it says that too.
    </p>
    <p>
        The playback scrubber announces your position and the track length,
        and can be moved in fifteen-second steps. Durations are spoken as
        durations — "three minutes seven seconds", not "three oh seven",
        which is how a screen reader reads a written timestamp.
    </p>
    <p>
        <strong>What we have not done:</strong> driven the whole app with the
        screen curtain on. The labels are written and the code is reviewed,
        but nobody has yet played a song, seeked, queued and downloaded
        without looking at the screen. Until they have, treat this as
        implemented rather than proven — and please tell us if it falls short.
    </p>

    <h2>3. Larger Text</h2>
    <p>
        Text scales with the size you choose in Settings, including the
        accessibility sizes. <strong>Tested on device at the largest
        setting.</strong>
    </p>
    <p>
        The layout changes shape rather than simply growing: film and show
        facts stack instead of sitting in a narrow column, and titles in lists
        wrap onto several lines rather than being cut off. Artwork and icons
        stay their own size, because scaling a picture helps nobody read.
    </p>
    <p>
        One known limit: some tiles are a fixed size, so a very long title in a
        grid still truncates. The full title is available on the item's own
        page and to VoiceOver.
    </p>

    <h2>4. Reduced Motion</h2>
    <p>
        Honoured throughout, and <strong>tested on device</strong>. The
        scrolling now-playing title holds still — it is the one thing in the
        app that moves continuously without being asked. Lyrics still follow
        the song so you do not lose your place, but the line arrives rather
        than travelling. Page turns in the reader and the filter chips change
        without animation.
    </p>
    <p>
        Cross-fades are left alone. An image changing opacity is not motion,
        and replacing it with a hard cut would make the app worse for no
        benefit.
    </p>

    <h2>5. Differentiate Without Colour</h2>
    <p>
        Nothing in the app is distinguished by colour alone. Download states
        each have their own symbol — a tick, an exclamation mark, a stop
        square — so they differ in shape before they differ in colour. Shuffle
        and repeat show a dot beneath them when active, rather than only
        changing colour. The track that is currently playing shows an
        equaliser over its artwork.
    </p>

    <h2>6. Sufficient Contrast</h2>
    <p>
        Measured, not judged by eye. Every text colour against every surface it
        is used on meets WCAG AA — 4.5:1 for body text — with the dimmest
        combination in use at 5.28:1.
    </p>
    <p>
        The accent colour is yours to choose, so we cannot check it once and be
        done. Where the accent is used for words rather than for a shape or a
        fill, the app adjusts it automatically until it clears 4.5:1 against
        the background behind it.
    </p>

    <h2>7. Dark Interface</h2>
    <p>
        Light, dark, or following the system, with an accent colour of your
        choosing. Set in Settings → Appearance.
    </p>

    <h2>8. Captions</h2>
    <p>
        Subtitle tracks are listed and selectable in the video player, and the
        selection survives seeking and leaving the app. Whether a given film
        has subtitles depends on the file you own — we display what is there,
        and the server can fetch subtitles for items that lack them.
    </p>

    <h2>9. Voice Control</h2>
    <p>
        Voice Control speaks the same labels VoiceOver does, so a labelled
        button is a button you can say the name of. We have written the labels
        to be short and speakable for this reason. We have not separately
        tested the app with Voice Control turned on.
    </p>

    <x-legal.accessibility-shared />
</x-layouts.legal>
