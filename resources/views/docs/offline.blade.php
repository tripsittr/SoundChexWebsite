<x-layouts.docs title="Offline & downloads">
    <h1>Offline &amp; downloads</h1>
    <p class="doc-lead">
        The whole catalogue mirrors to your device — a fraction of a megabyte gzipped — so browsing
        and search work with no network at all. Downloads make the media itself available anywhere.
    </p>

    <h2>How it works</h2>
    <ul>
        <li><strong>The catalogue mirror</strong> — every device keeps a compact JSON copy of the library. Browse, search and queue with no connection; the mirror refreshes whenever the server is reachable.</li>
        <li><strong>Per-item downloads</strong> — download a song, an album, a film or a book and it plays from local storage, network or not.</li>
        <li><strong>Downloads survive</strong> the app closing, and resume when it comes back — an interrupted album download picks up where it left off.</li>
        <li><strong>Download all</strong> — bulk download is gated on the device actually having the free space for it, checked before it starts rather than discovered at 80%.</li>
    </ul>

    <h2>Per platform</h2>
    <table>
        <tr><th>Platform</th><th>Offline story</th></tr>
        <tr><td><a href="{{ route('docs.show', 'app-macos') }}">macOS app</a></td><td>Catalogue mirror + downloads to local storage.</td></tr>
        <tr><td><a href="{{ route('docs.show', 'app-ios') }}">iOS app</a></td><td>Downloads live in native storage — deliberately outside the browser's cache, which iOS evicts. A downloaded album survives a full app close and plays on a plane.</td></tr>
        <tr><td>Web app (any browser)</td><td>Catalogue browsing and playback while the tab is open work well; a browser's own storage is at the browser's mercy, so treat downloads-in-browser as a convenience, not an archive. For dependable offline, use a native app.</td></tr>
    </table>

    <h2>Being straight about it</h2>
    <div class="doc-note">
        <p>
            Offline storage is the hardest problem in the codebase — mobile platforms evict browser
            storage aggressively, which is why downloads moved into native storage and why the
            offline system is being rebuilt carefully across all six target platforms rather than
            shipped everywhere at once. The rule we hold: <strong>a download either survives or it
            was never marked downloaded</strong>. If you see behaviour that breaks that rule,
            <a href="https://github.com/tripsittr/SoundChex/issues">report it</a> — it's treated as
            a serious bug, not a quirk.
        </p>
    </div>

    <h2>Practical notes</h2>
    <ul>
        <li>Download on Wi-Fi before travelling; check the item shows as downloaded, not queued.</li>
        <li>Downloads are per device — the phone's downloads don't consume the laptop's storage.</li>
        <li>Resume points sync when the device reconnects, so a chapter finished on a plane lands in your history afterwards.</li>
    </ul>
</x-layouts.docs>
