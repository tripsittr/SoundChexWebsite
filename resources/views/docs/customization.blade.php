<x-layouts.docs title="Customization">
    <h1>Customization</h1>
    <p class="doc-lead">
        Most of a SoundChex install is configured from the admin panel; a handful of things live in
        <code>.env</code> on the server. This page maps where everything is.
    </p>

    <h2>The admin panel</h2>
    <table>
        <tr><th>Page</th><th>What it controls</th></tr>
        <tr><td><strong>Library settings</strong></td><td>Watch folders, scanning behaviour — see <a href="{{ route('docs.show', 'libraries') }}">Libraries &amp; scanning</a></td></tr>
        <tr><td><strong>Metadata sources</strong></td><td>API keys and per-source enablement — see <a href="{{ route('docs.show', 'metadata') }}">Metadata &amp; integrations</a></td></tr>
        <tr><td><strong>Services</strong></td><td>Start/stop/logs for the background workers (macOS; other platforms run them natively — see <a href="{{ route('docs.show', 'workers') }}">Background workers</a>)</td></tr>
        <tr><td><strong>Server transfer</strong></td><td>Copying the library between machines — see <a href="{{ route('docs.show', 'moving-a-server') }}">Moving &amp; backups</a></td></tr>
        <tr><td><strong>Device reports</strong></td><td>What each connected device logged and reported back — the first stop when a phone misbehaves and isn't in the room</td></tr>
    </table>

    <h2>People</h2>
    <p>
        Accounts, roles, profiles and rating caps are covered in
        <a href="{{ route('docs.show', 'profiles') }}">Profiles &amp; kids mode</a>. Each profile
        personalises its own history, resume points, watchlist and highlights.
    </p>

    <h2>Server-side knobs (<code>.env</code>)</h2>
    <table>
        <tr><th>Key</th><th>What it does</th></tr>
        <tr><td><code>APP_URL</code></td><td>The address the server advertises to devices — port included. Wrong or portless, and phones can't find the server.</td></tr>
        <tr><td><code>APP_ENV</code></td><td><code>production</code> once the server is reachable from the internet: HTTPS URL generation on, detailed error pages off.</td></tr>
        <tr><td><code>LIBRARY_WATCH_FOLDERS</code></td><td>Watch folders as comma-separated absolute paths — the <code>.env</code> alternative to the admin page.</td></tr>
    </table>
    <p>After changing <code>.env</code>: <code>php artisan config:clear</code>.</p>

    <h2>Your files stay yours</h2>
    <p>
        Customization never means lock-in: the library keeps the
        <a href="{{ route('docs.show', 'libraries') }}">folder conventions</a> Plex, Jellyfin and
        Emby read, enrichment snapshots what it replaces, and originals are never deleted. Every
        choice here is reversible.
    </p>
</x-layouts.docs>
