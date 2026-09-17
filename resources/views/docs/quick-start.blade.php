<x-layouts.docs title="Quick start">
    <h1>Quick start</h1>
    <p class="doc-lead">
        From a fresh clone to playing your own media. On macOS or Linux this is one sitting;
        on Windows, follow <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a>
        instead — same ground, with the Windows-only traps called out at each step.
    </p>

    <h2>1. Check the requirements</h2>
    <p>
        PHP 8.4+, Node 22+, Composer, and FFmpeg on the PATH.
        <a href="{{ route('docs.show', 'requirements') }}">Requirements</a> has the details and install
        commands per platform.
    </p>

    <h2>2. Install the server</h2>
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
        <p><strong><code>storage:link</code> is easy to skip and fails silently.</strong> Without it,
        every avatar and artist image returns 404 with nothing explaining why. If images are missing
        later, this is the first thing to check.</p>
    </div>

    <h2>3. Create the owner account</h2>
    <p>
        Open <code>http://localhost:8000</code> and register. <strong>The first account becomes the
        owner automatically</strong> — no setup wizard, no license key.
    </p>

    <h2>4. Point it at your media</h2>
    <p>
        <strong>Admin → Library settings → watch folders</strong>, then run a scan:
    </p>
    <pre><code>php artisan library:scan</code></pre>
    <div class="doc-note">
        <p><strong>Start with a small folder</strong> — a dozen files, not the whole collection.
        A small scan proves paths resolve and playback works before you commit hours to a full one.
        Nothing is ever moved out of your watch folders until it has been catalogued and identified,
        and originals are never deleted.</p>
    </div>

    <h2>5. Keep the background workers running</h2>
    <pre><code>php artisan queue:work        # enrichment, transcoding, downloads
php artisan schedule:work     # scanning, backups, pruning</code></pre>
    <p>
        Without the queue worker, metadata never fills in and downloads never start.
        <a href="{{ route('docs.show', 'workers') }}">Background workers</a> covers running these at
        login on each OS.
    </p>

    <h2>6. Add metadata keys (optional)</h2>
    <p>
        Sources that need an API key — TMDB, AcoustID, Spotify, OpenSubtitles — are entered under
        <strong>Admin → Metadata sources</strong>. The rest work without one. A source with no key
        skips itself and says so in the log rather than silently returning nothing.
        See <a href="{{ route('docs.show', 'metadata') }}">Metadata & integrations</a>.
    </p>

    <h2>7. Put it on your devices</h2>
    <ul>
        <li><strong>Mac</strong> — install the <a href="{{ route('docs.show', 'app-macos') }}">macOS app</a>.</li>
        <li><strong>iPhone</strong> — the <a href="{{ route('docs.show', 'app-ios') }}">iOS app</a>, or open the library in Safari and use <em>Add to Home Screen</em>.</li>
        <li><strong>Anything else</strong> — any browser gets the full experience at <code>http://&lt;server-ip&gt;:8000/app</code>.</li>
    </ul>
    <p>
        To reach the server from outside your network, see
        <a href="{{ route('docs.show', 'remote-access') }}">Remote access</a>.
    </p>
</x-layouts.docs>
