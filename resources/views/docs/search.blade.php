<x-layouts.docs title="Search">
    <h1>Search</h1>
    <p class="doc-lead">
        One query across titles, metadata, cast, film dialogue and the text of books — and the
        result takes you to the moment, not just the item.
    </p>

    <h2>What one search box covers</h2>
    <table>
        <tr><th>Matches in…</th><th>What you get</th></tr>
        <tr><td>Titles &amp; metadata</td><td>Songs, albums, artists, films, series, episodes, books</td></tr>
        <tr><td>Cast &amp; credits</td><td>Everything a person appears in</td></tr>
        <tr><td>Film &amp; TV dialogue</td><td>A hit <strong>jumps playback to the moment the line is spoken</strong></td></tr>
        <tr><td>The text of books</td><td>A hit <strong>opens the book at that page</strong> — including scanned books, whose text is made searchable by OCR</td></tr>
    </table>

    <h2>Where the deep search comes from</h2>
    <ul>
        <li><strong>Dialogue</strong> — caption tracks, extracted from the files or fetched from OpenSubtitles (see <a href="{{ route('docs.show', 'metadata') }}">Metadata &amp; integrations</a>). No captions, no dialogue search for that title.</li>
        <li><strong>Books</strong> — EPUB and PDF text directly; scanned pages via OCR, which also makes them selectable in the reader.</li>
    </ul>

    <h2>Search respects the profile</h2>
    <p>
        A <a href="{{ route('docs.show', 'profiles') }}">kids profile's rating cap</a> filters search
        results the same as browsing — a title the profile can't see doesn't appear, and a direct
        link to it won't play either.
    </p>

    <h2>Offline</h2>
    <p>
        The catalogue mirrors to your device, so search works with no network at all — results that
        are downloaded play immediately; the rest wait for a connection. See
        <a href="{{ route('docs.show', 'offline') }}">Offline &amp; downloads</a>.
    </p>
</x-layouts.docs>
