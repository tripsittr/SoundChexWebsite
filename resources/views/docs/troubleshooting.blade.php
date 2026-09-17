<x-layouts.docs title="Troubleshooting">
    <h1>Troubleshooting</h1>
    <p class="doc-lead">
        The failures worth documenting are the silent ones — the app starts, looks right, and does
        nothing useful. Here they are, symptom first.
    </p>

    <h2>Symptom → cause</h2>
    <table>
        <tr><th>Symptom</th><th>Cause &amp; fix</th></tr>
        <tr><td>Pages render with no styling</td><td><code>npm run build</code> wasn't run — check <code>public/build/manifest.json</code> exists</td></tr>
        <tr><td>Avatars and artist images 404, everything else works</td><td><code>php artisan storage:link</code> was skipped or failed. On Windows, symlinks need Developer Mode or an Administrator terminal.</td></tr>
        <tr><td>Scan finds nothing</td><td>Watch-folder paths: absolute, comma-separated, readable by the PHP process. On Windows this is the most likely failure — see <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a>, step 7.</td></tr>
        <tr><td>Files catalogue but won't play</td><td><code>ffmpeg</code> isn't on the PATH. <code>ffmpeg -version</code> in the same shell that runs the server.</td></tr>
        <tr><td>Metadata never fills in / downloads never start / a transfer sits idle</td><td><code>php artisan queue:work</code> isn't running — see <a href="{{ route('docs.show', 'workers') }}">Background workers</a></td></tr>
        <tr><td>Phones can't find the server</td><td><code>APP_URL</code> missing its port, or the firewall. Confirm another device on the LAN can open <code>http://&lt;server-ip&gt;:8000/app</code> first.</td></tr>
        <tr><td><code>cURL error 60</code> on everything outbound</td><td>Windows PHP has no certificate bundle — <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a>, step 4</td></tr>
        <tr><td>Services page says unsupported</td><td>Expected off macOS — it's launchd-based. Run the workers natively instead.</td></tr>
        <tr><td>Locked out of your account</td><td><code>php artisan user:password you@example.com</code> at the server console — self-hosted installs have no reset email.</td></tr>
    </table>

    <h2>The tools you already have</h2>
    <ul>
        <li><strong>Admin → Device reports</strong> — every device reports its failures back to the server, filterable by device and log type. When "the phone doesn't work" and the phone isn't in the room, start here.</li>
        <li><strong>The test suite</strong> — <code>php artisan test</code> on the server. If it fails, the problem is the PHP or Node install, not your library.</li>
        <li><strong>The log</strong> — metadata sources that skip themselves (no key, no answer) say so in the log rather than failing silently.</li>
    </ul>

    <h2>Still stuck?</h2>
    <p>
        <a href="https://github.com/tripsittr/SoundChex/issues">Open an issue on GitHub</a> with the
        symptom, your OS, and anything Device reports shows. Silent failures that make it into this
        table started as somebody's bug report.
    </p>
</x-layouts.docs>
