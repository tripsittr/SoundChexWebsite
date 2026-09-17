<x-layouts.docs title="Libraries & scanning">
    <h1>Libraries &amp; scanning</h1>
    <p class="doc-lead">
        Point SoundChex at the folders your media lives in; it catalogues what it finds, identifies
        it, and keeps the library organised in conventions every other media tool already reads.
    </p>

    <h2>Watch folders</h2>
    <p>Two ways to set them:</p>
    <ul>
        <li><strong>Admin → Library settings → watch folders</strong> — the normal way.</li>
        <li><code>LIBRARY_WATCH_FOLDERS</code> in <code>.env</code> — absolute paths, comma-separated. On Windows, backslashes are fine (<code>D:\Media\Music,D:\Media\Films</code>); the split is on commas, so drive letters are never mistaken for separators.</li>
    </ul>

    <h2>Scanning</h2>
    <pre><code>php artisan library:scan</code></pre>
    <p>
        Scans also run on a schedule once <code>php artisan schedule:work</code> is running (see
        <a href="{{ route('docs.show', 'workers') }}">Background workers</a>), so day-to-day you just
        drop files into a watch folder and they appear.
    </p>
    <div class="doc-note">
        <p><strong>First scan? Start small.</strong> A dozen files prove that paths resolve and
        playback works before you commit a whole collection. This matters double on
        <a href="{{ route('docs.show', 'server-windows') }}">Windows</a>, where path handling is the
        most likely thing to differ.</p>
    </div>

    <h2>What a scan does — and never does</h2>
    <ul>
        <li>Files are identified by their tags and, for music, by acoustic fingerprint (Chromaprint → AcoustID), then enriched from the <a href="{{ route('docs.show', 'metadata') }}">metadata sources</a>.</li>
        <li><strong>Nothing is moved out of a watch folder until it has been catalogued and identified.</strong></li>
        <li><strong>Originals are never deleted.</strong></li>
    </ul>

    <h2>How files are organised</h2>
    <p>
        The library uses the conventions Plex, Jellyfin and Emby already read, so your files stay
        legible to anything else you point at them:
    </p>
    <table>
        <tr><th>Type</th><th>Layout</th></tr>
        <tr><td>Music</td><td><code>Artist/Album/01 Track.flac</code></td></tr>
        <tr><td>Films</td><td><code>Title (Year)/Title (Year).mkv</code></td></tr>
        <tr><td>TV</td><td><code>Series/Season 01/Series S01E01.mkv</code></td></tr>
        <tr><td>Books</td><td>EPUB, PDF and CBZ files, identified by their metadata</td></tr>
    </table>

    <h2>Four media types, one catalogue</h2>
    <p>
        Music, films, TV and books share a schema, a search box and a player. Resume points, history
        and watchlists behave identically for a song, an episode and a chapter. Video gets hardware
        transcoding, caption tracks and skip markers; books get highlights, private notes and OCR of
        scanned pages so their text is selectable and searchable.
    </p>

    <h2>If a scan misbehaves</h2>
    <table>
        <tr><th>Symptom</th><th>Check</th></tr>
        <tr><td>Scan finds nothing</td><td>Watch-folder paths — absolute, comma-separated, readable by the PHP process</td></tr>
        <tr><td>Files catalogue but won't play</td><td>FFmpeg on the PATH (<code>ffmpeg -version</code>)</td></tr>
        <tr><td>Metadata never fills in</td><td><code>php artisan queue:work</code> isn't running — enrichment is a background job</td></tr>
        <tr><td>Artwork missing everywhere</td><td><code>php artisan storage:link</code> was skipped</td></tr>
    </table>
</x-layouts.docs>
