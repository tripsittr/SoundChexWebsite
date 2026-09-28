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
        <li>No crash reporting to us. The app does send crash and startup
            diagnostics — but to <em>your</em> server, at
            <code>/api/v1/device-reports</code>, so a phone that will not play
            something can be diagnosed by the person who runs the library.
            Those reports never leave your machine, and we have no endpoint
            to receive them.</li>
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
        <tr><td>Notification schedules for timed downloads</td><td>Warning you before a download is removed</td></tr>
    </table>
    <p>
        Downloads are saved where you can see them, in the device's own file
        manager, under <code>SoundChex/Media</code>. They are your files: you
        can open, copy, move or delete them without the app's involvement, and
        deleting one simply means the app offers it again.
    </p>
    {{ $storage }}

    <h2>3. What crosses the network</h2>
    <ul>
        <li><strong>To your server:</strong> your sign-in, browsing, playback, downloads, resume points and history — the app working as an app. What the server keeps is described in <a href="{{ route('legal.show', 'server-privacy') }}">Server Privacy</a>, and it stays on that machine.</li>
        <li><strong>To Tripsittr LLC: nothing.</strong> The app has no endpoint of ours to call.</li>
        <li><strong>To anyone else: nothing.</strong> No CDN, no font service, no analytics host. If your server operator configured remote access through a tunnel provider, traffic transits it encrypted the way any web traffic transits infrastructure.</li>
    </ul>

    {{ $slot }}

    <h2>4. Your choices</h2>
    <p>
        There is no consent banner here, because there is nothing to consent
        to: no collection to opt out of, no profile being built, no data to
        sell. What follows is what you can actually control.
    </p>
    <table>
        <tr><th>Choice</th><th>Where</th><th>Effect</th></tr>
        <tr>
            <td>Which server the app talks to</td>
            <td>The connect screen, and Settings</td>
            <td>The app contacts that address and nothing else. Sign out and it
                contacts nothing at all.</td>
        </tr>
        <tr>
            <td>Notifications</td>
            <td>Asked the first time you choose a timed download; changeable in
                system settings</td>
            <td>Declining means no warning before a timed download is removed.
                Nothing else changes, and the app never notifies you about
                anything else.</td>
        </tr>
        <tr>
            <td>What is downloaded, and for how long</td>
            <td>The download button on any film or episode</td>
            <td>Keep it indefinitely, or for a day, three days or a week.
                Timed downloads delete themselves; the entry stays so you can
                fetch it again.</td>
        </tr>
        <tr>
            <td>Per-person profiles and content caps</td>
            <td>Settings → the app's admin section</td>
            <td>Give each person their own history and resume points, cap a
                profile at a content rating, and PIN-protect the ones that are
                not capped. See <a href="{{ route('legal.show', 'age-suitability') }}">Age Suitability</a>.</td>
        </tr>
        <tr>
            <td>Sending a diagnostic report</td>
            <td>Automatic on a crash, to your own server</td>
            <td>Stop the server and nothing is sent. The reports go to your
                machine, and their retention is yours to set.</td>
        </tr>
        <tr>
            <td>Your history and resume points</td>
            <td>Your server's admin panel</td>
            <td>Held by the server, not the app. Delete a profile there and its
                history goes with it.</td>
        </tr>
    </table>
    <p>
        <strong>Rights people usually have to ask for — access, portability,
        deletion — you already hold.</strong> The data is on hardware you own,
        in a SQLite file you can copy, read or delete without asking anyone,
        including us. There is no request form because there is nobody to make
        the request to.
    </p>

    <h2>5. Deleting the app's data</h2>
    {{ $deletion }}
    <p>The library, your accounts and your history live on the server, not in the app — removing the app removes only this device's copy and its downloads.</p>

    <h2>6. Children</h2>
    <p>
        The app collects nothing from anyone, children included. It also ships
        the controls: profiles, a content-rating cap applied on every screen,
        and a PIN on the profiles that are not capped — all set from inside the
        app, and enforced by your server
        (<a href="{{ route('docs.show', 'profiles') }}">how that works</a>).
        What those controls do and do not cover is set out in
        <a href="{{ route('legal.show', 'age-suitability') }}">Age Suitability</a>.
    </p>

    <h2>7. Changes</h2>
    <p>Any future change to sections 1–3 — even an optional feature — will change this document first and appear in the release changelog in plain words. Zero collection is the commitment.</p>
</x-layouts.legal>
