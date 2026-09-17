<x-layouts.legal title="SoundChex Server Privacy">
    <h1>SoundChex Server — Privacy</h1>
    <p class="doc-lead">The short version is absolute: <strong>the server sends nothing to Tripsittr LLC. Ever.</strong> No telemetry, no analytics, no crash reporting to us, no update phone-home, no account with us. This page exists to be specific about what data exists, where it lives, and where it goes.</p>

    <h2>1. What data the server holds — all of it on your machine</h2>
    <table>
        <tr><th>Data</th><th>Where it lives</th></tr>
        <tr><td>Accounts and passwords (hashed) for your household</td><td>The SQLite database file on your server</td></tr>
        <tr><td>Profiles, listening/watching history, resume points, watchlists, highlights and notes</td><td>Same database</td></tr>
        <tr><td>Your media catalogue and artwork</td><td>Same database + local storage folder</td></tr>
        <tr><td>Your media files themselves</td><td>Your watch folders — never moved until catalogued, never deleted</td></tr>
        <tr><td>Logs and device reports (what your own devices reported failing)</td><td>Local log files and the same database — "Admin → Device reports" is your devices reporting to <em>your</em> server, not to us</td></tr>
    </table>
    <p>Tripsittr LLC can see none of this. There is no mechanism by which it could reach us, because none was built.</p>

    <h2>2. Network connections the server makes</h2>
    <p>Every outbound connection is one you configured, and each goes directly from your machine to that service:</p>
    <ul>
        <li><strong>Metadata sources</strong> — TMDB, MusicBrainz, AcoustID, Open Library, iTunes, Spotify, OpenSubtitles — queried only if enabled, with your keys, under their privacy policies. What they see is the lookup itself (e.g. a film title, an audio fingerprint), coming from your IP address.</li>
        <li><strong>Subtitle and artwork downloads</strong> — same character: your server fetching a file you asked for.</li>
        <li><strong>Server-to-server transfers</strong> — only between two machines you control, only after the four-digit-code approval on both ends.</li>
        <li><strong>Nothing else.</strong> No connection to Tripsittr LLC infrastructure exists in the server. When SCNet launches, connecting to it will be a separate, explicit, off-by-default choice with its own privacy notice.</li>
    </ul>

    <h2>3. Data collected by Tripsittr LLC: none</h2>
    <p>We do not know you installed SoundChex. We do not know your library size, your uptime, your version, or your IP address. If the GitHub download counter ticks up, that's GitHub's statistic, governed by GitHub's privacy policy, and it isn't tied to anything you run.</p>

    <h2>4. Your household's privacy is your configuration</h2>
    <p>Because you are the operator, a few things are yours to decide and document for your users (your family, usually): who has accounts, that profiles carry no password and are not a security boundary (<a href="{{ route('docs.show', 'profiles') }}">documented here</a>), and whether the server is reachable from the internet. If you expose it publicly, login is rate-limited, but the choice — and the responsibility to your users — is yours.</p>

    <h2>5. Deleting everything</h2>
    <p>Delete the SoundChex directory (or the installed app), the SQLite database and the storage folder, and every trace of the catalogue, accounts and history is gone. Your media files, as always, remain exactly where they were.</p>

    <h2>6. Changes</h2>
    <p>If a future version ever adds any network behaviour beyond section 2 — even an update check — this document will change first, the changelog will say so in plain words, and it will be opt-in. "Zero data collection" is a commitment, not a default setting.</p>
</x-layouts.legal>
