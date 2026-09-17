<x-layouts.docs title="GitHub & source setup">
    <h1>GitHub &amp; source setup</h1>
    <p class="doc-lead">
        Everything SoundChex ships starts at
        <a href="https://github.com/tripsittr/SoundChex">github.com/tripsittr/SoundChex</a> — the
        source, the compiled installers, the issue tracker and the changelog. This page explains how
        the pieces fit and how to run from source.
    </p>

    <h2>The repository, in one minute</h2>
    <table>
        <tr><th>Where</th><th>What</th></tr>
        <tr><td><strong>Releases</strong></td><td>Compiled installers — the <code>.dmg</code>s for macOS and, when they ship, the <code>.exe</code>s for Windows — for both <strong>SoundChex</strong> (the client) and <strong>SoundChex Server</strong>. Each release carries its changelog. This is what the <a href="{{ route('download') }}">download page</a> links to.</td></tr>
        <tr><td><strong>Issues</strong></td><td>The support channel. Bugs, questions and feature requests all go here — there is no separate forum.</td></tr>
        <tr><td><strong>The code</strong></td><td>MIT-licensed. The server (Laravel/PHP), the web interface, and the Tauri shells all live in the one repository.</td></tr>
        <tr><td><strong><code>docs/</code></strong></td><td>The developer-facing docs, kept next to the code they describe.</td></tr>
    </table>
    <div class="doc-note">
        <p><strong>Hear about new versions:</strong> on the repository page, <em>Watch → Custom →
        Releases</em>. GitHub then emails you when a release lands — the served interface updates
        itself, so this mostly matters for the server and the app shells.</p>
    </div>

    <h2>Installers or source?</h2>
    <ul>
        <li><strong>Installers</strong> — right for the client apps, and for a host machine where a <a href="{{ route('docs.show', 'dmg-setup') }}">.dmg</a> / <a href="{{ route('docs.show', 'exe-setup') }}">.exe</a> is the comfortable route.</li>
        <li><strong>Source</strong> — right for Linux hosts (no installer yet), for staying on the newest code, and for contributing. It's a normal Laravel app; nothing exotic.</li>
    </ul>

    <h2>Running from source</h2>
    <p>
        Clone and follow the guide for your OS — each covers its own toolchain and traps:
    </p>
    <pre><code>git clone https://github.com/tripsittr/SoundChex.git
cd SoundChex</code></pre>
    <ul>
        <li><a href="{{ route('docs.show', 'server-macos') }}">Install on macOS</a></li>
        <li><a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a> — read this one even if you're comfortable; two of its steps fail silently when skipped</li>
        <li><a href="{{ route('docs.show', 'server-linux') }}">Install on Linux</a></li>
    </ul>

    <h2>Updating a source install</h2>
    <pre><code>git pull
composer install
npm install
php artisan migrate
npm run build</code></pre>
    <p>
        Then restart the <a href="{{ route('docs.show', 'workers') }}">background workers</a> so they
        run the new code. Because the interface is served, every connected device picks up the update
        on its next page load — the apps themselves rarely need reinstalling.
    </p>
    <div class="doc-warn">
        <p><strong>Migrations are part of every update.</strong> <code>git pull</code> without
        <code>php artisan migrate</code> is the classic source-install mistake — new code against an
        old schema fails in ways that don't name the cause.</p>
    </div>

    <h2>Building the installers yourself</h2>
    <p>
        Every <code>.dmg</code> and <code>.exe</code> we publish can be reproduced from the repo —
        that's the point of the code being public:
    </p>
    <pre><code>npm run build              # web assets first, always
npm run tauri build        # the client app for the OS you're on
npm run build:server       # the SoundChex Server app</code></pre>
    <p>
        Builds are per-platform — a Mac produces the <code>.dmg</code>, a Windows machine the
        <code>.exe</code>; no machine cross-builds the other's installer. Platform specifics live in
        the per-OS install pages, including the macOS DMG-bundling recovery in
        <a href="{{ route('docs.show', 'server-macos') }}">Install on macOS</a>.
    </p>

    <h2>Contributing</h2>
    <p>
        Issues first — even for a fix you intend to write, so the work is visible. Run the tests
        (<code>php artisan test</code>, <code>npx vitest run</code>) before opening a PR, and expect
        every change to reach <code>main</code> through a pull request with a changelog entry. The
        repository's <code>AGENTS.md</code> describes the conventions in full.
    </p>
</x-layouts.docs>
