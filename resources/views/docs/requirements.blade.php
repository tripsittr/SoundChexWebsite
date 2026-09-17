<x-layouts.docs title="Requirements">
    <h1>Requirements</h1>
    <p class="doc-lead">
        SoundChex is deliberately light: one PHP application, one SQLite file, and FFmpeg.
        No database server, no containers required, no cloud dependency.
    </p>

    <h2>Server</h2>
    <table>
        <tr><th>Component</th><th>Version</th><th>Why</th></tr>
        <tr><td><strong>PHP</strong></td><td>8.4+</td><td>The server itself. 8.3 satisfies the dependency constraints, but everything is tested on 8.4.</td></tr>
        <tr><td><strong>Composer</strong></td><td>current</td><td>PHP dependencies.</td></tr>
        <tr><td><strong>Node</strong></td><td>22+</td><td>Building the front end (<code>npm run build</code>).</td></tr>
        <tr><td><strong>FFmpeg</strong></td><td>on the PATH</td><td>Transcoding, caption extraction and duration reading all shell out to <code>ffmpeg</code> and <code>ffprobe</code> by name. Files will catalogue but not play without it.</td></tr>
    </table>
    <p>
        The database is SQLite — a single file at <code>database/database.sqlite</code>, created by
        <code>php artisan migrate</code>. One file to back up, no service to keep running, and a
        library of a few thousand items never gets near its limits.
    </p>

    <h2>Server operating systems</h2>
    <table>
        <tr><th>OS</th><th>Status</th></tr>
        <tr><td>macOS</td><td>Fully supported — built and run continuously, including managed background services.</td></tr>
        <tr><td>Linux</td><td>Runs anywhere PHP does. The Services admin page is macOS-only; use systemd for the workers. See <a href="{{ route('docs.show', 'server-linux') }}">Install on Linux</a>.</td></tr>
        <tr><td>Windows 10/11</td><td>Supported with known caveats (certificate bundle, symlink permissions). See <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a>.</td></tr>
    </table>

    <h2>Hardware</h2>
    <ul>
        <li><strong>Any reasonably modern machine.</strong> The server is a normal PHP app; cataloguing and browsing are light.</li>
        <li><strong>Video transcoding is the one heavy job.</strong> Hardware transcoding is used where available; a machine that can play a film can generally serve one.</li>
        <li><strong>Disk</strong> — your media plus a little: artwork, the SQLite database (hundreds of KB to a few MB), and transient transcode output.</li>
    </ul>

    <h2>Optional</h2>
    <ul>
        <li><strong>Metadata API keys</strong> — TMDB, AcoustID, Spotify and OpenSubtitles need free keys; MusicBrainz, Open Library, iTunes and file tags work without any. See <a href="{{ route('docs.show', 'metadata') }}">Metadata & integrations</a>.</li>
        <li><strong>A domain or Tailscale account</strong> — only for <a href="{{ route('docs.show', 'remote-access') }}">remote access</a>; nothing is needed for use at home.</li>
        <li><strong>Rust + platform build tools</strong> — only if you are building the native apps yourself rather than downloading them.</li>
    </ul>
</x-layouts.docs>
