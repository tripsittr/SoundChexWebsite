<x-layouts.docs title="Introduction">
    <h1>Introduction</h1>
    <p class="doc-lead">
        SoundChex is a self-hosted media library for music, films, television and books —
        one catalogue, one player, on every device you own. It runs on your own machine;
        your files stay yours and are never uploaded anywhere.
    </p>

    <h2>How it's put together</h2>
    <p>
        A SoundChex install has two halves:
    </p>
    <ul>
        <li><strong>The server</strong> — a Laravel application (PHP 8.4, SQLite) running on one machine in your home. It watches your media folders, catalogues what it finds, fetches metadata, transcodes video, and serves the library to everything else.</li>
        <li><strong>The apps</strong> — native shells for <a href="{{ route('docs.show', 'app-macos') }}">macOS</a>, <a href="{{ route('docs.show', 'app-ios') }}">iOS</a> and, in time, <a href="{{ route('docs.show', 'app-windows') }}">Windows</a>, <a href="{{ route('docs.show', 'app-linux') }}">Linux</a>, <a href="{{ route('docs.show', 'app-ipados') }}">iPadOS</a> and <a href="{{ route('docs.show', 'app-android') }}">Android</a> — plus any web browser, which gets the full experience.</li>
    </ul>
    <p>
        The interface itself is served by your server rather than compiled into the apps, so when the
        server updates, every device gets the new version on its next page load. Only the connect
        screen and the offline shell live inside the app binaries.
    </p>
    <p>
        The database is a single SQLite file — one file to back up, no database service to keep
        running, and a library of a few thousand items never gets near its limits.
    </p>

    <h2>One catalogue, four media types</h2>
    <p>
        Music, films, TV and books share a schema, a search box and a player. A song, an episode and
        a chapter are all things you were part-way through, and SoundChex treats them that way: resume
        points, history and watchlists work identically across all four.
    </p>
    <ul>
        <li><strong>Music</strong> — identified by fingerprint (Chromaprint/AcoustID) and tags, organised <code>Artist/Album/</code>.</li>
        <li><strong>Films & TV</strong> — hardware transcoding, caption tracks, skip markers, and search inside dialogue.</li>
        <li><strong>Books</strong> — EPUB, PDF and CBZ with highlights, private notes, and OCR of scanned pages so the text is selectable and searchable.</li>
    </ul>

    <h2>It plays well with others</h2>
    <p>
        Libraries are organised the way Plex, Jellyfin and Emby already read —
        <code>Artist/Album/</code>, <code>Title (Year)/</code>, <code>Series/Season 01/</code> — so
        your files stay legible to anything else you point at them. Adopting SoundChex doesn't lock
        you in, and leaving it doesn't scramble your folders.
    </p>

    <h2>What it costs</h2>
    <p>
        Nothing. SoundChex is AGPLv3-licensed and the source is public at
        <a href="https://github.com/tripsittr/SoundChex">github.com/tripsittr/SoundChex</a>. There are
        no feature gates. The optional <a href="{{ route('home') }}#pricing">SCNet subscription</a>
        (the SoundChex Network, coming soon) buys remote access through a hosted relay for people who
        don't want to run their own tunnel — convenience, never capability.
    </p>

    <h2>Where to next</h2>
    <ul>
        <li>New install → <a href="{{ route('docs.show', 'quick-start') }}">Quick start</a></li>
        <li>Windows specifically → <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a> (it has its own pitfalls, called out honestly)</li>
        <li>Reaching it from outside the house → <a href="{{ route('docs.show', 'remote-access') }}">Remote access</a></li>
    </ul>
</x-layouts.docs>
