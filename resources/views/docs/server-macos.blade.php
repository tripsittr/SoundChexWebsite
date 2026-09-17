<x-layouts.docs title="Install the server on macOS">
    <h1>Install the server on macOS</h1>
    <p class="doc-lead">
        macOS is the platform SoundChex is developed on — everything here has been run many times,
        including managed background services via launchd.
    </p>

    <h2>1. Toolchain</h2>
    <pre><code>brew install php composer node ffmpeg</code></pre>
    <p>
        Check versions afterwards: <code>php -v</code> (8.4+), <code>node -v</code> (22+),
        <code>ffmpeg -version</code>. macOS ships a system certificate bundle, so outbound HTTPS
        works out of the box — no extra configuration needed.
    </p>

    <h2>2. Install</h2>
    <pre><code>git clone https://github.com/tripsittr/SoundChex.git
cd SoundChex

composer install
npm install

cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link

npm run build
php artisan serve</code></pre>
    <div class="doc-warn">
        <p><strong>Don't skip <code>storage:link</code>.</strong> Without it every avatar and artist
        image 404s while everything else works — the classic silent failure of a fresh install.</p>
    </div>
    <p>
        Open <code>http://localhost:8000</code> and register — the first account becomes the owner.
    </p>

    <h2>3. The background workers</h2>
    <p>Two long-running processes do the real work:</p>
    <pre><code>php artisan queue:work        # enrichment, transcoding, downloads, transfers
php artisan schedule:work     # scanning, backups, pruning</code></pre>
    <p>
        On macOS you have two good options for keeping them alive:
    </p>
    <ul>
        <li><strong>The Services page</strong> — <strong>Admin → Services</strong> starts, stops and shows logs for both workers. It is built on launchd and is macOS-only.</li>
        <li><strong>launchd at login</strong> — the repository ships ready-made plists (<code>com.soundchex.queue.plist</code>, <code>com.soundchex.scheduler.plist</code>, <code>com.soundchex.serve.plist</code>) in <code>Documentation &amp; Planning/</code>. Copy them into <code>~/Library/LaunchAgents/</code> and adjust the paths to your clone.</li>
    </ul>
    <div class="doc-note">
        <p><strong>If you ever move the repository folder</strong>, the launchd plists keep pointing
        at the old path and the workers restart-loop silently. Re-edit the paths and reload them.</p>
    </div>

    <h2>4. Scan a small library first</h2>
    <p>
        <strong>Admin → Library settings → watch folders</strong>, then:
    </p>
    <pre><code>php artisan library:scan</code></pre>
    <p>
        Start with a dozen files. When they appear under <code>http://localhost:8000/app/music</code>
        and play, point it at the real collection. See
        <a href="{{ route('docs.show', 'libraries') }}">Libraries &amp; scanning</a>.
    </p>

    <h2>5. The desktop apps (optional)</h2>
    <p>
        Prebuilt downloads are on the <a href="https://github.com/tripsittr/SoundChex/releases">releases page</a>.
        To build them yourself you additionally need <a href="https://rustup.rs">Rust</a>:
    </p>
    <pre><code>npm run tauri build           # the client (.app / .dmg)
npm run build:server          # SoundChex Server.app, with service controls</code></pre>
    <div class="doc-note">
        <p><strong>If the DMG bundling step fails</strong> while the <code>.app</code> builds fine
        (Tauri exits 0 either way — read the output, not the exit code), detach stale disk images and
        build just the app bundle:</p>
        <pre><code>hdiutil info | grep -B14 "rw\." | grep -oE "^/dev/disk[0-9]+" | xargs -n1 hdiutil detach -force
rm -f src-tauri/target/release/bundle/macos/rw.*
npm run tauri build -- --bundles app</code></pre>
    </div>

    <h2>Verify</h2>
    <ol>
        <li><code>php artisan test</code> — if tests fail, the problem is the PHP install, not you.</li>
        <li>Open <code>/app</code> — proves the library reads.</li>
        <li>Scan the small folder — proves paths resolve.</li>
        <li>Play something — proves FFmpeg is found and streaming works.</li>
    </ol>
</x-layouts.docs>
