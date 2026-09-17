<x-layouts.docs title="Install the server on Windows">
    <h1>Install the server on Windows 10/11</h1>
    <p class="doc-lead">
        Written to be followed in order. Each step says how to tell it worked, because several of the
        failures here are silent — the app starts, looks right, and does nothing useful.
    </p>
    <div class="doc-note">
        <p><strong>Honesty first:</strong> SoundChex is developed on macOS, and the Windows port has
        had less real-world mileage. The path-handling, LAN-detection and Tailscale-lookup fixes for
        Windows exist specifically because a Unix-shaped codebase breaks there — which is also why
        step 7 says to scan a small folder first. If something misbehaves,
        <a href="https://github.com/tripsittr/SoundChex/issues">report it</a>; it will get fixed.</p>
    </div>

    <h2>1. Install the toolchain</h2>
    <table>
        <tr><th>Tool</th><th>Where</th><th>Notes</th></tr>
        <tr><td><strong>PHP 8.4+</strong></td><td><a href="https://windows.php.net/download">windows.php.net</a> or <code>winget install PHP.PHP</code></td><td></td></tr>
        <tr><td><strong>Composer</strong></td><td><a href="https://getcomposer.org/download/">getcomposer.org</a></td><td></td></tr>
        <tr><td><strong>Node 22+</strong></td><td><code>winget install OpenJS.NodeJS</code></td><td></td></tr>
        <tr><td><strong>FFmpeg</strong></td><td><code>winget install Gyan.FFmpeg</code></td><td>Transcoding, captions and durations all shell out to it</td></tr>
    </table>
    <p>
        (Rust and Visual Studio Build Tools are only needed to build the desktop app — the server
        runs without them.)
    </p>
    <div class="doc-warn">
        <p><strong>Reopen your terminal after installing.</strong> <code>winget</code> changes the
        PATH and an open shell won't see it. Then check: <code>php -v</code>, <code>node -v</code>,
        <code>composer -V</code>, <code>ffmpeg -version</code>. FFmpeg is the one most often missing —
        without it, files catalogue but won't play, with nothing obvious in the app.</p>
    </div>

    <h2>2. Get the code</h2>
    <pre><code>git clone https://github.com/tripsittr/SoundChex.git
cd SoundChex

composer install
npm install</code></pre>

    <h2>3. Configure it</h2>
    <pre><code>copy .env.example .env
php artisan key:generate</code></pre>
    <p>Then open <code>.env</code> and set two things.</p>
    <p><strong>Where the media is.</strong> Absolute paths, comma-separated. Backslashes are fine —
    the split is on commas, so a drive letter is never mistaken for a separator:</p>
    <pre><code>LIBRARY_WATCH_FOLDERS=D:\Media\Music,D:\Media\Films</code></pre>
    <p><strong>What the app calls itself.</strong> This is the address it advertises to phones and
    other devices, so the port matters:</p>
    <pre><code>APP_URL=http://localhost:8000</code></pre>

    <h2>4. Give PHP a certificate bundle</h2>
    <p>
        Windows PHP ships without one, so <strong>every outbound HTTPS request fails</strong> with
        <code>cURL error 60: unable to get local issuer certificate</code> — metadata, artwork,
        subtitles and server transfers alike. It reads as a network problem; it's a configuration one.
        macOS and Linux don't hit this.
    </p>
    <p>
        Download <a href="https://curl.se/ca/cacert.pem">cacert.pem</a>, put it somewhere permanent,
        and point <code>php.ini</code> at it:
    </p>
    <pre><code>curl.cainfo = "C:\php\extras\ssl\cacert.pem"
openssl.cafile = "C:\php\extras\ssl\cacert.pem"</code></pre>
    <p>
        Restart <code>php artisan serve</code> <strong>and</strong> <code>queue:work</code> afterwards
        — both need it. <strong>Check:</strong>
    </p>
    <pre><code>php -r "var_dump(file_get_contents('https://api.themoviedb.org/3/'));"</code></pre>
    <p>Anything other than an SSL error means it works.</p>

    <h2>5. Database, storage link, front end</h2>
    <pre><code>php artisan migrate --force
php artisan storage:link
npm run build</code></pre>
    <ul>
        <li><strong>Migrate</strong> creates SQLite at <code>database\database.sqlite</code> — no file exists in a fresh clone and none is needed.</li>
        <li><strong><code>storage:link</code> fails silently if skipped</strong> — every avatar and artist image 404s. Windows restricts symlink creation: turn on <strong>Settings → System → For developers → Developer Mode</strong>, or run from an Administrator terminal.</li>
        <li><strong>Check:</strong> <code>public\build\manifest.json</code> exists (else pages render unstyled), and <code>public\storage</code> opens to the contents of <code>storage\app\public</code>.</li>
    </ul>

    <h2>6. Start it</h2>
    <pre><code>php artisan serve                # the app
php artisan queue:work           # enrichment, transcoding, downloads
php artisan schedule:work        # scanning, backups, pruning</code></pre>
    <p>
        Three terminals — or set the workers up as Windows services with
        <a href="https://nssm.cc">NSSM</a>. The <strong>Admin → Services</strong> page that manages
        them on macOS is launchd-based; on Windows it detects this and says so rather than failing.
    </p>
    <p>
        <strong>Check:</strong> open <code>http://localhost:8000</code>, register — the first account
        becomes the owner.
    </p>

    <h2>7. Scan the library — start small</h2>
    <pre><code>php artisan library:scan</code></pre>
    <p>
        Start with a <strong>small</strong> folder — a dozen files, not the whole collection. This is
        the step most likely to fail on Windows, because path handling is where a Unix-shaped codebase
        breaks. If the scan finds nothing, or finds files it can't then play, check the watch-folder
        paths first. <strong>Check:</strong> items appear at <code>http://localhost:8000/app/music</code>
        and play.
    </p>

    <h2>If something is wrong</h2>
    <table>
        <tr><th>Symptom</th><th>Cause</th></tr>
        <tr><td>Pages render with no styling</td><td><code>npm run build</code> was not run</td></tr>
        <tr><td>Avatars and artist images 404</td><td><code>php artisan storage:link</code> skipped or failed</td></tr>
        <tr><td>Scan finds nothing</td><td>Watch folder paths — step 7</td></tr>
        <tr><td>Files catalogued but won't play</td><td><code>ffmpeg</code> not on the PATH</td></tr>
        <tr><td>Phones can't find the server</td><td><code>APP_URL</code> missing its port, or the firewall</td></tr>
        <tr><td><code>cURL error 60</code> on anything</td><td>No CA bundle — step 4</td></tr>
        <tr><td>Services page says unsupported</td><td>Expected — it is launchd-only</td></tr>
    </table>
    <p>
        The app records what fails: <strong>Admin → Device reports</strong> shows what each device
        sent back, filterable by device and log type — more use than guessing.
    </p>
</x-layouts.docs>
