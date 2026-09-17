<x-layouts.docs title="Profiles & kids mode">
    <h1>Profiles &amp; kids mode</h1>
    <p class="doc-lead">
        A household shares one server but not one taste. Accounts are the security boundary;
        profiles are the people.
    </p>

    <h2>Users vs profiles — two different things, on purpose</h2>
    <table>
        <tr><th></th><th>Purpose</th><th>Security</th></tr>
        <tr><td><strong>User</strong></td><td>An account with a password. Owns permissions.</td><td>A real boundary</td></tr>
        <tr><td><strong>Profile</strong></td><td>One person's taste and place in the library.</td><td><strong>Not</strong> a boundary</td></tr>
    </table>
    <p>
        A self-hosted install typically has one or two accounts. Each profile carries its own
        history, resume points, highlights and watchlist. <strong>Profiles have no password</strong> —
        switching is a convenience, exactly as every streaming service treats it. Anything that must
        be enforced lives on the account, and the admin panel enforces its own permissions regardless
        of the active profile.
    </p>

    <h2>Roles</h2>
    <table>
        <tr><th>Role</th><th>Can do</th></tr>
        <tr><td><code>super_admin</code></td><td>Everything, including granting roles</td></tr>
        <tr><td><code>admin</code></td><td>Manage the catalogue and settings</td></tr>
        <tr><td><code>owner</code></td><td>Same as admin; kept for installs that used it</td></tr>
        <tr><td><code>member</code></td><td>Browse the catalogue, rate and annotate</td></tr>
    </table>
    <p>The first account registered on a fresh install becomes the owner automatically.</p>

    <h2>Kids mode</h2>
    <p>
        A profile can cap the highest rating it may see, and the cap is enforced <em>everywhere</em>:
    </p>
    <ul>
        <li>every browse page,</li>
        <li>every search query,</li>
        <li>and the detail, watch and stream routes directly — so <strong>a direct link doesn't slip past the filter</strong>. Filtering only the browse pages while a pasted URL still plays would read as working while failing, which is precisely the bug this design exists to prevent.</li>
    </ul>
    <div class="doc-note">
        <p><strong>Unrated titles pass through.</strong> Most music and books carry no certification,
        and excluding them would empty a kids profile rather than protect it. If your kids profile
        exists to gate films and TV, this is the behaviour you want; know it's there.</p>
    </div>

    <h2>Locked out?</h2>
    <p>
        A self-hosted install has no reset email configured, so password resets happen at the
        server's console:
    </p>
    <pre><code>php artisan user:password you@example.com</code></pre>
    <p>It verifies the new credentials actually authenticate before reporting success.</p>
</x-layouts.docs>
