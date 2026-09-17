<x-layouts.docs title="Moving & backups">
    <h1>Moving &amp; backups</h1>
    <p class="doc-lead">
        SoundChex can copy itself — catalogue, media, profiles — to another machine over a tailnet
        or a forwarded address, with approval required on both ends. And because the database is one
        SQLite file, everyday backups are refreshingly boring.
    </p>

    <h2>Backups</h2>
    <ul>
        <li><strong>The catalogue</strong> is a single file: <code>database/database.sqlite</code>. Copy it and you have the titles, artists, profiles, history and resume points.</li>
        <li><strong>Artwork and uploads</strong> live under <code>storage/app/public/</code>.</li>
        <li><strong>Your media files</strong> are wherever your watch folders are — SoundChex never moves them out from under you, so back them up the way you already do.</li>
        <li>Scheduled backups run under the scheduler (<a href="{{ route('docs.show', 'workers') }}">Background workers</a>).</li>
    </ul>

    <h2>Moving to a new machine — the built-in transfer</h2>
    <p>
        Both machines run the same SoundChex code. The one being copied <strong>approves</strong>;
        the one doing the copying <strong>asks and pulls</strong>.
    </p>

    <h3>Before you start</h3>
    <ul>
        <li>Both machines: SoundChex installed and migrated (<code>php artisan migrate</code>).</li>
        <li>Both machines: <strong><code>php artisan queue:work</code> running.</strong> This is the one people forget — without it a transfer is approved and then sits doing nothing.</li>
        <li>Receiver: enough free disk for what's coming, and <code>php artisan storage:link</code> done, or artwork 404s afterwards.</li>
        <li>Reachable: the receiver must be able to open the source in a browser — try <code>https://&lt;source-address&gt;/soundchex.json</code> first. If that doesn't answer, nothing below will work.</li>
    </ul>

    <h3>1. On the receiving machine — ask</h3>
    <p><strong>Admin → Server transfer.</strong> Fill in the source's address, choose what to bring, enter your password, press <strong>Ask that server</strong>, and note the four-digit code it shows.</p>
    <table>
        <tr><th>What</th><th>Notes</th></tr>
        <tr><td><strong>The catalogue</strong></td><td>Titles, artists, albums, artwork. Minutes.</td></tr>
        <tr><td><strong>The media files</strong></td><td>The actual music, films and books. Hours.</td></tr>
        <tr><td><strong>Profiles and history</strong></td><td>Comes with the catalogue — the database holds both.</td></tr>
        <tr><td><strong>Settings and keys</strong></td><td>Usually leave off — the new machine wants its own.</td></tr>
    </table>
    <p>Nothing has moved yet. Nothing <em>can</em> move until the next step.</p>

    <h3>2. On the source machine — approve</h3>
    <p>
        The request appears in <strong>Admin → Server transfer</strong> with the address it came
        from, what the machine calls itself, what it's asking for, and <strong>a four-digit code</strong>.
        Check the code matches the one on the other screen — that's how you know this is the request
        you just started and not someone else's. Type your password and press <strong>Approve</strong>.
    </p>

    <h3>3. Back on the receiver — start</h3>
    <p>Press <strong>Check for approval</strong>. The transfer starts and runs in the background:</p>
    <ul>
        <li>Files already present with the right content are skipped.</li>
        <li>Each file is verified after it arrives; anything corrupt is deleted and recorded rather than kept.</li>
        <li><strong>Pause and resume whenever</strong> — it picks up where it stopped, not from the beginning.</li>
        <li>It can be stopped from either end at any moment; every request the receiver makes re-checks that it's still allowed.</li>
    </ul>
    <p>Progress shows files done, gigabytes moved, and anything that failed.</p>

    <h2>After the move</h2>
    <p>
        If the old machine is retiring, update anything that pointed at it —
        <a href="{{ route('docs.show', 'remote-access') }}">tunnels and tailnet names</a>,
        <code>APP_URL</code>, and the devices' saved connections. Scan once on the new machine to
        confirm the watch folders resolve.
    </p>
</x-layouts.docs>
