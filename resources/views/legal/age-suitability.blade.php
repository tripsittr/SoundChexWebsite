<x-layouts.legal title="Age Suitability">
    <h1>Age suitability</h1>

    <p class="doc-lead">
        What SoundChex shows, who decides it, and what the app can and cannot
        guarantee about what a child sees. Written for parents, and for the app
        stores that ask us to justify an age rating.
    </p>

    <h2>1. The app contains no content of its own</h2>
    <p>
        SoundChex is a client for a media server you run yourself. It ships with
        no content, no store, no recommendations from us and no way to browse
        anyone else's library. Installed and never connected, it shows a screen
        asking for a server address. That is all it can do.
    </p>
    <p>
        Everything it displays is a file already on a machine you control, put
        there by you. The library is managed on the server; the app is the
        window onto it — <strong>and the window has locks</strong>.
    </p>

    <h2>2. What the app itself contains</h2>
    <ul>
        <li>No advertising, of any kind.</li>
        <li>No in-app purchases, and no paid tier inside the app.</li>
        <li>No user-generated content, no comments, no messaging, no social
            features — there is nobody else to interact with.</li>
        <li>No web browser, and no links to content outside your own server
            except our documentation and licence pages.</li>
        <li>No analytics, no tracking, no advertising identifier. There is no
            SoundChex service collecting anything, because there is no SoundChex
            service.</li>
        <li>No location, contacts, camera or microphone access.</li>
    </ul>
    <p>
        Installed and never connected to a server, SoundChex shows a screen
        asking for an address. That is all it can do.
    </p>

    <h2>3. The parental controls, which are in the app</h2>
    <p>
        The app does not merely honour restrictions set elsewhere. From its
        admin section you can create a household profile, set the content rating
        it is capped at, and set a PIN on the profiles that are not capped —
        without leaving the app or opening a browser.
    </p>
    <p>
        The cap then applies everywhere: browsing, search, shuffle,
        recommendations and direct links alike, so a capped profile cannot reach
        a title by any route the app offers.
    </p>
    <p>The ladder, from least to most restricted:</p>
    <p>
        <code>G</code> → <code>TV-Y</code> → <code>TV-G</code> →
        <code>PG</code> → <code>TV-PG</code> → <code>PG-13</code> →
        <code>TV-14</code> → <code>R</code> → <code>TV-MA</code> →
        <code>NC-17</code>
    </p>
    <p>
        Setting a cap allows everything at or below it. A profile capped at
        <code>PG</code> sees <code>G</code>, <code>TV-Y</code>,
        <code>TV-G</code> and <code>PG</code> titles, and nothing above.
    </p>

    <h3>What the cap does not do</h3>
    <p>
        Worth stating plainly, because a filter people trust incorrectly is
        worse than no filter:
    </p>
    <ul>
        <li><strong>Unrated titles pass.</strong> A film with no rating in its
            metadata is shown to every profile. Most music and most books carry
            no rating at all, and excluding everything unrated would empty a
            child's library rather than protect it. If a specific title matters,
            rate it on the server.</li>
        <li><strong>Ratings come from metadata, not from the file.</strong> They
            are whatever your server recorded — from a provider, or from you.
            Nothing inspects the content itself.</li>
        <li><strong>The cap is only as good as its PIN.</strong> Set one on the
            uncapped profiles; without it, anyone holding the device can switch
            to a profile that has no cap.</li>
        <li><strong>Downloads already on the device</strong> remain playable by
            whoever holds the device.</li>
    </ul>

    <h2>4. Why we rate the app as we do</h2>
    <p>
        The app contains no objectionable content of its own, and it carries no
        advertising, no purchases and no way to reach anyone else's library.
        What it displays is entirely determined by the library its operator
        points it at, which may be anything from children's films to material
        rated for adults.
    </p>
    <p>
        We therefore rate SoundChex for the <em>possibility</em> of mature
        content rather than its presence — the position any media player is in —
        and we ship the controls that let a household decide: per-person
        profiles, a rating cap enforced on every screen, and a PIN on the
        profiles that are not capped.
    </p>

    <h2>5. For parents</h2>
    <ul>
        <li>Give each person their own profile, and set a cap on the
            children's — both from Settings inside the app.</li>
        <li>Set a PIN on the profiles that are not capped, or the cap is a
            suggestion rather than a control.</li>
        <li>Rate the titles that matter. An unrated file is visible to everyone.</li>
        <li>Remember that downloads outlive the connection: a file on the device
            plays without the server, and without its rules.</li>
    </ul>

    <h2>6. Questions</h2>
    <p>
        If something here is unclear or wrong, the
        <a href="https://github.com/tripsittr/SoundChex">source is public</a> and
        so is the issue tracker. This page describes behaviour we can point at
        in the code; if the code changes, this page changes with it.
    </p>
</x-layouts.legal>
