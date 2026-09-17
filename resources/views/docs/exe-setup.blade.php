<x-layouts.docs title="Windows setup (.exe)">
    <h1>Windows setup (.exe)</h1>
    <p><span class="inline-block rounded-full border border-base-500 bg-base-700 px-3 py-1 text-xs font-semibold text-ink-300">Installers coming soon</span></p>
    <p class="doc-lead">
        Windows installers for <strong>SoundChex</strong> (the client) and
        <strong>SoundChex Server</strong> are being compiled alongside the macOS releases. This page
        is written ahead so it's ready the day they land on the
        <a href="{{ route('download') }}">download page</a> — and so the honest caveats are on record
        before anyone hits them.
    </p>

    <h2>What will ship</h2>
    <ul>
        <li><strong>SoundChex</strong> — a standard Windows installer (<code>.exe</code>; an <code>.msi</code> is also produced by the build). Installs the client app; WebView2 is pulled in automatically if the machine doesn't have it (Windows 11 and most Windows 10 already do).</li>
        <li><strong>SoundChex Server</strong> — the host app for the machine that holds the library.</li>
    </ul>

    <h2>Installing</h2>
    <ol>
        <li>Download the <code>.exe</code> from the <a href="{{ route('download') }}">download page</a> (it links the latest <a href="https://github.com/tripsittr/SoundChex/releases">GitHub release</a>).</li>
        <li>Run it and follow the installer — per-user install, no reboot.</li>
        <li>Launch from the Start menu; the client's connect screen asks for your server's address.</li>
    </ol>

    <h2>First launch &amp; SmartScreen</h2>
    <div class="doc-warn">
        <p><strong>Expect a SmartScreen warning at first.</strong> Until releases carry a code-signing
        certificate, Windows shows "Windows protected your PC" for a downloaded installer. Click
        <strong>More info → Run anyway</strong>. As with the
        <a href="{{ route('docs.show', 'dmg-setup') }}">macOS warning</a>, this reflects the missing
        signature, not the contents — and the <a href="{{ route('docs.show', 'github-setup') }}">source
        is public</a> if you'd rather build it yourself.</p>
    </div>

    <h2>The server on Windows, today</h2>
    <p>
        Nothing about the client installer changes the server story:
        <a href="{{ route('docs.show', 'server-windows') }}">Install on Windows</a> runs the library
        host from source right now, including the two silent traps (the PHP certificate bundle and
        the storage symlink) and running the workers with NSSM. A Windows machine can host the
        library for the whole house today; the installer just makes the client half effortless.
    </p>

    <h2>Building the installer yourself (now)</h2>
    <p>
        Impatient and equipped? With Rust (MSVC), the VS Build Tools and the repo cloned:
    </p>
    <pre><code>npm run build
npm run tauri:build       # .msi and .exe in src-tauri\target\release\bundle\
npm run build:server      # the SoundChex Server app</code></pre>
    <p>
        A first build compiles the whole Rust dependency tree and takes a while. A confirmed working
        build reported <a href="https://github.com/tripsittr/SoundChex/issues">on GitHub</a> is
        exactly what turns this page's badge to Available.
    </p>
</x-layouts.docs>
