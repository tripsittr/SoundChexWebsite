<x-layouts.docs title="Metadata & integrations">
    <h1>Metadata &amp; integrations</h1>
    <p class="doc-lead">
        Watch folders are scanned, files are identified, and nine sources are asked in turn. Every
        enrichment run snapshots what it replaced — so a provider revising its own record is
        recoverable rather than merely regrettable.
    </p>

    <h2>The nine sources</h2>
    <table>
        <tr><th>Source</th><th>Provides</th><th>Key needed?</th></tr>
        <tr><td><strong>TMDB</strong></td><td>Films &amp; TV — titles, artwork, cast, certifications</td><td>Yes (free)</td></tr>
        <tr><td><strong>MusicBrainz</strong></td><td>Music — releases, artists, relationships</td><td>No</td></tr>
        <tr><td><strong>AcoustID</strong></td><td>Music — identifies files by acoustic fingerprint (Chromaprint)</td><td>Yes (free)</td></tr>
        <tr><td><strong>Open Library</strong></td><td>Books — titles, authors, covers</td><td>No</td></tr>
        <tr><td><strong>iTunes</strong></td><td>Music &amp; books — artwork, release data</td><td>No</td></tr>
        <tr><td><strong>Spotify</strong></td><td>Music — artist images, popularity, related data</td><td>Yes (free)</td></tr>
        <tr><td><strong>OpenSubtitles</strong></td><td>Films &amp; TV — caption tracks</td><td>Yes (free)</td></tr>
        <tr><td><strong>File tags</strong></td><td>Whatever your files already know about themselves</td><td>—</td></tr>
        <tr><td><strong>OCR</strong></td><td>Scanned books — makes the text selectable and searchable</td><td>—</td></tr>
    </table>

    <h2>Adding keys</h2>
    <p>
        <strong>Admin → Metadata sources.</strong> Keys are entered there, not in <code>.env</code>.
        A source with no key <strong>skips itself and says so in the log</strong> rather than silently
        returning nothing — so a half-configured install still enriches from the keyless sources.
    </p>
    <div class="doc-warn">
        <p><strong>On Windows, add the certificate bundle first.</strong> Without it every source
        fails with <code>cURL error 60</code>, which reads as a network problem. See
        <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a>, step 4.</p>
    </div>

    <h2>Enrichment is reversible</h2>
    <p>
        Every run snapshots what it replaced. If a provider revises its record — a renamed album, a
        re-credited cast — the previous state is recoverable. Combined with the rule that
        <a href="{{ route('docs.show', 'libraries') }}">originals are never deleted</a>, metadata
        mistakes are annoying, not destructive.
    </p>

    <h2>Enrichment runs in the background</h2>
    <p>
        Lookups happen on the queue, not during the scan — so <code>php artisan queue:work</code>
        must be running or metadata never fills in. See
        <a href="{{ route('docs.show', 'workers') }}">Background workers</a>.
    </p>

    <h2>Beyond metadata</h2>
    <ul>
        <li><strong>Plex / Jellyfin / Emby</strong> — SoundChex reads and writes the same folder conventions, so a library can serve several tools at once during a migration.</li>
        <li><strong>Web app manifest</strong> — the library installs to a phone's home screen as an app, with your artwork as the icon.</li>
        <li><strong>SCNet</strong> — the hosted relay for remote access, coming soon; see <a href="{{ route('docs.show', 'remote-access') }}">Remote access</a>.</li>
    </ul>
</x-layouts.docs>
