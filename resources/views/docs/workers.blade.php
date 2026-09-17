<x-layouts.docs title="Background workers">
    <h1>Background workers</h1>
    <p class="doc-lead">
        Two long-running processes do everything that isn't serving a page. If exactly one thing
        about your install seems broken — metadata never appears, a transfer sits at zero — the
        queue worker not running is the most likely cause.
    </p>

    <h2>What each one does</h2>
    <table>
        <tr><th>Process</th><th>Responsibilities</th></tr>
        <tr><td><code>php artisan queue:work</code></td><td>Metadata enrichment, transcoding, downloads, server transfers</td></tr>
        <tr><td><code>php artisan schedule:work</code></td><td>Scheduled library scans, backups, pruning</td></tr>
    </table>
    <div class="doc-warn">
        <p><strong>The queue is the one people forget.</strong> Without it, a server transfer is
        approved and then sits doing nothing at all; enrichment jobs pile up and metadata never fills
        in. No error appears anywhere obvious — the work simply doesn't happen.</p>
    </div>

    <h2>Keeping them alive per OS</h2>

    <h3>macOS</h3>
    <ul>
        <li><strong>Admin → Services</strong> — starts, stops and shows logs for both workers, built on launchd. macOS only.</li>
        <li>Or install the shipped launchd plists (<code>com.soundchex.queue.plist</code>, <code>com.soundchex.scheduler.plist</code>) from <code>Documentation &amp; Planning/</code> into <code>~/Library/LaunchAgents/</code> — they start the workers at login. Edit the paths if your clone lives somewhere else.</li>
    </ul>

    <h3>Linux</h3>
    <p>
        systemd user services — a ready-to-adapt unit file is in
        <a href="{{ route('docs.show', 'server-linux') }}">Install on Linux</a>. Remember
        <code>loginctl enable-linger</code> so they survive logout.
    </p>

    <h3>Windows</h3>
    <p>
        Run each in its own terminal, or install them as Windows services with
        <a href="https://nssm.cc">NSSM</a>. The Services admin page detects that launchd is absent
        and says so rather than failing.
    </p>

    <h2>Telling that they're running</h2>
    <ul>
        <li>Add a file to a watch folder — it should appear in the library after the next scheduled scan without you running anything.</li>
        <li>New items should gain artwork and metadata within minutes (with sources configured).</li>
        <li>On macOS, <strong>Admin → Services</strong> shows live status and logs.</li>
    </ul>
</x-layouts.docs>
