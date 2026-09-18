<x-layouts.legal title="SoundChex Server Terms">
    <h1>SoundChex Server — Terms</h1>
    <p class="doc-lead">These terms cover the SoundChex server software — the application that hosts your library on your own machine, whether installed from a <a href="{{ route('docs.show', 'dmg-setup') }}">packaged installer</a> or <a href="{{ route('docs.show', 'github-setup') }}">from source</a>.</p>

    <h2>1. The license is the GNU AGPLv3</h2>
    <p>The server is open-source software released by Tripsittr LLC under the GNU Affero General Public License, version 3 or later (AGPLv3). The <code>LICENSE</code> file in the repository is the governing license for SoundChex's own code. In plain words: you may use, copy, modify and redistribute it, for any purpose, provided you keep it under the AGPLv3 and pass the same freedoms on — and, because the AGPL covers software used over a network, if you run a modified version that others reach over a network, you must offer those users its corresponding source. It is provided "as is", without warranty of any kind.</p>
    <p><strong>A commercial license is available as an alternative.</strong> If you cannot or do not wish to meet the AGPLv3's obligations, Tripsittr LLC offers the server under a separate paid commercial license. Unless you hold one, the AGPLv3 governs your use in full; enquire through the contact in the site footer.</p>
    <p><strong>Bundled third-party software.</strong> The packaged server runtime bundles third-party components — the PHP interpreter (PHP License), the Caddy web server (Apache 2.0), SQLite (public domain), and a Mozilla CA certificate bundle (MPL 2.0), among others. These keep their own licenses; the <code>THIRD-PARTY-LICENSES</code> file shipped with the runtime lists them in full. The AGPLv3 (or a commercial license) covers SoundChex's own code, not these bundled components.</p>

    <h2>2. It runs on your hardware, under your control</h2>
    <ul>
        <li>You choose the machine, the operating system, the media it watches, and who can reach it.</li>
        <li>You are the data controller of everything on it — accounts you create for your household, profiles, listening history, and the media files themselves.</li>
        <li>We have no access to your server. There is no remote administration by us, no license check, no activation, no kill switch.</li>
    </ul>

    <h2>3. Your media is your responsibility</h2>
    <p>The server catalogues and plays files you already have. It does not acquire media, and these terms are not a license to infringe copyright. You are responsible for having the rights to the files in your library, and for complying with the laws where you live — including if you choose to expose your server to the internet.</p>

    <h2>4. Third-party services are your relationships</h2>
    <p>If you configure metadata sources (TMDB, MusicBrainz, AcoustID, Open Library, iTunes, Spotify, OpenSubtitles), your server talks to them directly, using keys you obtained, under their terms — Tripsittr LLC is not a party to those exchanges. The same goes for tunnels and VPNs you configure for <a href="{{ route('docs.show', 'remote-access') }}">remote access</a>.</p>

    <h2>5. Backups are yours to make</h2>
    <p>The software includes backup and transfer tooling (<a href="{{ route('docs.show', 'moving-a-server') }}">documented here</a>), but running it, verifying it and keeping copies is your operation. Software that moves and deletes real files deserves tested backups.</p>

    <h2>6. No warranty; limitation of liability</h2>
    <p>As the AGPLv3 states: the software is provided "as is", without warranty of any kind, express or implied. To the maximum extent permitted by law, Tripsittr LLC and contributors are not liable for any claim or damages arising from the software or its use — including data loss. (Then again, see section 5.)</p>

    <h2>7. Updates</h2>
    <p>Updates are published as source and as releases; nothing is pushed to your machine. Applying them — and reading each release's changelog first — is your call.</p>

    <h2>8. These terms don't expand the license</h2>
    <p>If anything here conflicts with the AGPLv3 for the software itself, the AGPLv3 wins. These terms exist to be specific about responsibilities, not to take back what the license grants.</p>
</x-layouts.legal>
