@props(['platform', 'available' => true])
<x-layouts.legal :title="'SoundChex for '.$platform.' Privacy'">
    <h1>SoundChex for {{ $platform }} — Privacy</h1>
    @unless ($available)
        <p><span class="inline-block rounded-full border border-base-500 bg-base-700 px-3 py-1 text-xs font-semibold text-ink-300">App not yet released — policy published ahead</span></p>
    @endunless
    <p class="doc-lead"><strong>The {{ $platform }} app collects no data and contains no trackers.</strong> It talks to exactly one party: the server whose address you typed. This page is specific about what the app stores on the device and what crosses the network.</p>

    <h2>1. Data collected by Tripsittr LLC: none</h2>
    <ul>
        <li>No analytics or telemetry SDKs — none are compiled in, first-party or third-party.</li>
        <li>No crash reporting to us.</li>
        <li>No advertising identifiers, no fingerprinting.</li>
        <li>No account with Tripsittr LLC — the app has no signup and no login with us. You sign in to <em>your own server</em>.</li>
    </ul>

    <h2>2. What the app stores on this device</h2>
    <p>Everything below stays on the device, for the app's own function:</p>
    <table>
        <tr><th>Data</th><th>Purpose</th></tr>
        <tr><td>The server address(es) you entered</td><td>Reconnecting, and racing routes to pick the fastest</td></tr>
        <tr><td>Your session with your server</td><td>Staying signed in to your own library</td></tr>
        <tr><td>The catalogue mirror (titles, artwork references — a fraction of a megabyte)</td><td>Offline browsing and search</td></tr>
        <tr><td>Media you chose to download</td><td>Offline playback</td></tr>
    </table>
    {{ $storage }}

    <h2>3. What crosses the network</h2>
    <ul>
        <li><strong>To your server:</strong> your sign-in, browsing, playback, downloads, resume points and history — the app working as an app. What the server keeps is described in <a href="{{ route('legal.show', 'server-privacy') }}">Server Privacy</a>, and it stays on that machine.</li>
        <li><strong>To Tripsittr LLC: nothing.</strong> The app has no endpoint of ours to call.</li>
        <li><strong>To anyone else: nothing.</strong> No CDN, no font service, no analytics host. If your server operator configured remote access through a tunnel provider, traffic transits it encrypted the way any web traffic transits infrastructure.</li>
    </ul>

    {{ $slot }}

    <h2>4. Deleting the app's data</h2>
    {{ $deletion }}
    <p>The library, your accounts and your history live on the server, not in the app — removing the app removes only this device's copy and its downloads.</p>

    <h2>5. Children</h2>
    <p>The app collects nothing from anyone, children included. Kids-mode restrictions are enforced by your server (<a href="{{ route('docs.show', 'profiles') }}">how that works</a>).</p>

    <h2>6. Changes</h2>
    <p>Any future change to sections 1–3 — even an optional feature — will change this document first and appear in the release changelog in plain words. Zero collection is the commitment.</p>
</x-layouts.legal>
