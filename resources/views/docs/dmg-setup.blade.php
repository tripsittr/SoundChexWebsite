<x-layouts.docs title="macOS setup (.dmg)">
    <h1>macOS setup (.dmg)</h1>
    <p class="doc-lead">
        Two disk images are published for macOS: <strong>SoundChex</strong> (the client — install it
        on every Mac in the house) and <strong>SoundChex Server</strong> (install it on the one
        machine that hosts the library). Same steps for both.
    </p>

    <h2>1. Download the right one</h2>
    <ul>
        <li><strong>SoundChex.dmg</strong> — the app you browse, play and read with.</li>
        <li><strong>SoundChex Server.dmg</strong> — the host app, with start/stop/log controls for the library's background services.</li>
    </ul>
    <p>
        Both come from the <a href="{{ route('download') }}">download page</a>, which points at the
        latest <a href="https://github.com/tripsittr/SoundChex/releases">GitHub release</a>.
    </p>

    <h2>2. Install</h2>
    <ol>
        <li>Open the <code>.dmg</code> — a window appears with the app and an Applications shortcut.</li>
        <li><strong>Drag the app onto Applications.</strong> Don't run it from inside the disk image; macOS treats that as a temporary location.</li>
        <li>Eject the disk image (⌘E on the mounted volume, or the eject arrow in Finder's sidebar) and delete the <code>.dmg</code> if you like.</li>
    </ol>

    <h2>3. First launch &amp; Gatekeeper</h2>
    <div class="doc-warn">
        <p><strong>Expect a warning on first launch.</strong> Current releases are not yet notarized
        with Apple, so macOS will say the app is from an unidentified developer and offer only
        "Move to Trash" or "Cancel". This is Gatekeeper doing its job on an unsigned app, not a
        defect — and because the code is <a href="{{ route('docs.show', 'github-setup') }}">public</a>,
        you can always build the same app yourself instead.</p>
    </div>
    <p>To open it anyway, either:</p>
    <ul>
        <li><strong>Right-click the app in Applications → Open → Open</strong> — the warning gains an "Open" button when launched this way, and macOS remembers the choice; or</li>
        <li>launch it normally once, then go to <strong>System Settings → Privacy &amp; Security</strong>, scroll to the blocked-app notice, and press <strong>Open Anyway</strong>.</li>
    </ul>
    <p>Either way this is a one-time step per app; subsequent launches are normal. Signed and notarized releases are on the roadmap, and this page will drop this section the day they ship.</p>

    <h2>4. After installing</h2>
    <h3>SoundChex (the client)</h3>
    <p>
        The connect screen asks for your server's address — a LAN address like
        <code>http://192.168.1.20:8000</code>, a tailnet name, or a tunnel hostname
        (<a href="{{ route('docs.show', 'remote-access') }}">Remote access</a>). The interface is
        served by your server, so the app keeps itself current; the binary only carries the connect
        screen and the offline shell.
    </p>
    <h3>SoundChex Server (the host app)</h3>
    <p>
        Runs on the machine that holds the library and gives the background services a face —
        the queue and scheduler workers can be started, stopped and inspected without a terminal
        (the same controls as <strong>Admin → Services</strong>, which is launchd-based and
        macOS-only). The server itself is the PHP application described in
        <a href="{{ route('docs.show', 'server-macos') }}">Install on macOS</a>.
    </p>

    <h2>Updating</h2>
    <p>
        Download the new <code>.dmg</code> and drag the app to Applications again — replacing the
        old one is the whole update. Day to day this is rare: the served interface updates the moment
        the server does. Watch the repository (<em>Watch → Custom → Releases</em>) to hear when a new
        shell ships.
    </p>

    <h2>Uninstalling</h2>
    <p>
        Drag the app to the Trash. Your library, catalogue and settings live with the server, not in
        the client app — removing a client loses nothing but its saved connection.
    </p>
</x-layouts.docs>
