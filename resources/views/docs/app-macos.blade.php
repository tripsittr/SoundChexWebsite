<x-layouts.docs title="SoundChex on macOS">
    <h1>SoundChex on macOS</h1>
    <p><span class="inline-block rounded-full bg-accent px-3 py-1 text-xs font-semibold text-white">Available</span></p>
    <p class="doc-lead">
        Two apps, both built and shipping: the <strong>SoundChex</strong> client for everyone in the
        house, and <strong>SoundChex Server</strong> for the machine that hosts the library.
    </p>

    <h2>The client</h2>
    <p>
        Get the <code>.dmg</code> from the <a href="{{ route('download') }}">download page</a> and
        install it — <a href="{{ route('docs.show', 'dmg-setup') }}">macOS setup (.dmg)</a> walks
        through the drag-to-Applications step and the first-launch Gatekeeper prompt. Then enter
        your server's address on the connect screen — a LAN address
        (<code>http://192.168.1.20:8000</code>), a tailnet name, or a tunnel hostname all work.
    </p>
    <p>
        The interface is served by your server, so the app updates itself the moment your server
        does — no reinstall. Only the connect screen and the offline shell live in the binary.
    </p>
    <p>
        The app remembers every address it has seen for your server and
        <a href="{{ route('docs.show', 'remote-access') }}">races them</a>, so a laptop that leaves
        the house switches from LAN to tunnel without you doing anything.
    </p>

    <h2>SoundChex Server</h2>
    <p>
        The host app for the machine that runs the library. It wraps the server with service
        controls — the queue and scheduler workers can be started, stopped and inspected from
        <strong>Admin → Services</strong> (launchd-based, macOS-only). If you prefer the terminal,
        <a href="{{ route('docs.show', 'server-macos') }}">Install on macOS</a> covers running the
        server bare.
    </p>

    <h2>Offline</h2>
    <p>
        The catalogue mirrors to the device, so browsing and search work with no network; downloaded
        items play offline and downloads survive the app closing. See
        <a href="{{ route('docs.show', 'offline') }}">Offline &amp; downloads</a>.
    </p>

    <h2>Building it yourself</h2>
    <p>
        <code>npm run tauri build</code> in the repo produces the <code>.app</code> and
        <code>.dmg</code>; <code>npm run build:server</code> produces SoundChex Server. Details and
        the DMG-bundling gotcha are in <a href="{{ route('docs.show', 'server-macos') }}">Install on macOS</a>.
    </p>
</x-layouts.docs>
