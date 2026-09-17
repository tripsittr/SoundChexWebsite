<x-layouts.legal title="SoundChex Server Terms">
    <h1>SoundChex Server — Terms</h1>
    <p class="doc-lead">These terms cover the SoundChex server software — the application that hosts your library on your own machine, whether installed from a <a href="{{ route('docs.show', 'dmg-setup') }}">packaged installer</a> or <a href="{{ route('docs.show', 'github-setup') }}">from source</a>.</p>

    <h2>1. The license is the MIT License</h2>
    <p>The server is open-source software released by Tripsittr LLC under the MIT License. The license text in the repository is the complete and only license. In plain words: you may use, copy, modify and redistribute it, for any purpose, provided the license notice is kept; and it is provided "as is", without warranty of any kind.</p>

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
    <p>As the MIT License states: the software is provided "as is", without warranty of any kind, express or implied. To the maximum extent permitted by law, Tripsittr LLC and contributors are not liable for any claim or damages arising from the software or its use — including data loss. (Then again, see section 5.)</p>

    <h2>7. Updates</h2>
    <p>Updates are published as source and as releases; nothing is pushed to your machine. Applying them — and reading each release's changelog first — is your call.</p>

    <h2>8. These terms don't expand the license</h2>
    <p>If anything here conflicts with the MIT License for the software itself, the MIT License wins. These terms exist to be specific about responsibilities, not to take back what the license grants.</p>
</x-layouts.legal>
