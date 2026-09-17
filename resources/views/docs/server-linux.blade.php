<x-layouts.docs title="Install the server on Linux">
    <h1>Install the server on Linux</h1>
    <p class="doc-lead">
        The server is a normal Laravel application and runs anywhere PHP 8.4 does. Linux is the
        natural home for an always-on server — the one thing it lacks is the macOS Services page,
        so the workers run under systemd instead.
    </p>
    <div class="doc-note">
        <p><strong>Honesty first:</strong> development happens on macOS, and Linux has had less
        real-world mileage than the docs might suggest. The steps are straightforward — but if you
        hit something, <a href="https://github.com/tripsittr/SoundChex/issues">report it</a>.</p>
    </div>

    <h2>1. Toolchain (Debian/Ubuntu shown)</h2>
    <pre><code>sudo apt install ffmpeg git unzip
# PHP 8.4 — via your distribution, or the Sury repository on Debian/Ubuntu:
sudo apt install php8.4-cli php8.4-sqlite3 php8.4-xml php8.4-curl php8.4-mbstring php8.4-zip php8.4-gd
# Composer: https://getcomposer.org/download/
# Node 22+: https://nodejs.org or your distribution's NodeSource packages</code></pre>
    <p>
        Check: <code>php -v</code> (8.4+), <code>node -v</code> (22+), <code>ffmpeg -version</code>.
        Linux has a system certificate bundle, so outbound HTTPS works without extra setup.
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
php artisan serve --host=0.0.0.0</code></pre>
    <div class="doc-warn">
        <p><strong>Don't skip <code>storage:link</code></strong> — without it every avatar and artist
        image 404s silently.</p>
    </div>
    <p>
        Set <code>APP_URL</code> in <code>.env</code> to the address other devices will use, port
        included — e.g. <code>APP_URL=http://192.168.1.20:8000</code>. It is what the server
        advertises to phones. Open it, register, and the first account becomes the owner.
    </p>

    <h2>3. Workers under systemd</h2>
    <p>
        The <strong>Admin → Services</strong> page is launchd-based and macOS-only; on Linux run the
        two workers as user services. Example — <code>~/.config/systemd/user/soundchex-queue.service</code>:
    </p>
    <pre><code>[Unit]
Description=SoundChex queue worker
After=network.target

[Service]
WorkingDirectory=/home/you/SoundChex
ExecStart=/usr/bin/php artisan queue:work --tries=3
Restart=always

[Install]
WantedBy=default.target</code></pre>
    <p>
        Duplicate it as <code>soundchex-scheduler.service</code> with
        <code>ExecStart=/usr/bin/php artisan schedule:work</code>, then:
    </p>
    <pre><code>systemctl --user daemon-reload
systemctl --user enable --now soundchex-queue soundchex-scheduler
loginctl enable-linger $USER    # keep them running when logged out</code></pre>

    <h2>4. Scan a small library first</h2>
    <p>
        <strong>Admin → Library settings → watch folders</strong>, then
        <code>php artisan library:scan</code>. A dozen files first; when they appear and play, add the
        real collection. See <a href="{{ route('docs.show', 'libraries') }}">Libraries &amp; scanning</a>.
    </p>

    <h2>Building the desktop app (optional)</h2>
    <p>To build the Linux client rather than waiting for prebuilt packages:</p>
    <pre><code>sudo apt install libwebkit2gtk-4.1-dev build-essential curl wget file \
  libxdo-dev libssl-dev libayatana-appindicator3-dev librsvg2-dev
curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh

npm run tauri build     # produces .deb, .rpm and .AppImage</code></pre>

    <h2>Verify</h2>
    <ol>
        <li><code>php artisan test</code> — failures here mean the PHP install, not the port.</li>
        <li>Open <code>/app</code> from another device on the LAN — proves <code>APP_URL</code> and the firewall.</li>
        <li>Scan the small folder — proves paths resolve.</li>
        <li>Play something — proves FFmpeg is found and streaming works.</li>
    </ol>
</x-layouts.docs>
