<x-layouts.legal title="Cookie Policy">
    <h1>Cookie Policy</h1>
    <p class="doc-lead">This site sets exactly two cookies, both strictly necessary for the site to function, both first-party, neither capable of tracking you. That's the policy; here are the specifics.</p>

    <h2>The complete list</h2>
    <table>
        <tr><th>Cookie</th><th>What it does</th><th>Lifetime</th><th>Type</th></tr>
        <tr>
            <td><code>soundchex_session</code></td>
            <td>Identifies your browsing session so forms (the SCNet waitlist) can work. Contains a random identifier, nothing about you.</td>
            <td>2 hours, then expires</td>
            <td>Strictly necessary, first-party</td>
        </tr>
        <tr>
            <td><code>XSRF-TOKEN</code></td>
            <td>Protects forms against cross-site request forgery — it proves a submission came from this site and not a malicious one.</td>
            <td>2 hours, then expires</td>
            <td>Strictly necessary, first-party</td>
        </tr>
    </table>

    <h2>What we deliberately don't have</h2>
    <ul>
        <li><strong>No analytics cookies</strong> — we run no analytics at all.</li>
        <li><strong>No advertising or targeting cookies</strong> — no ads, no ad networks, no retargeting.</li>
        <li><strong>No third-party cookies</strong> — no external service is embedded in these pages, so none can set one.</li>
        <li><strong>No fingerprinting or "cookieless tracking"</strong> — removing cookies and tracking you anyway would violate the spirit of this page; we don't.</li>
    </ul>

    <h2>Why there's no cookie banner</h2>
    <p>Consent banners exist for cookies that are not necessary — analytics, advertising, preferences shared with third parties. Strictly necessary cookies don't require consent under GDPR/ePrivacy, and they're the only kind we set. A banner here would be theater.</p>

    <h2>Controlling them</h2>
    <p>You can block or delete cookies in your browser at any time. Blocking these two breaks nothing except submitting the waitlist form; every page still reads fine.</p>

    <h2>The apps and the server</h2>
    <p>The SoundChex apps talk to <em>your</em> server, and any session state they hold is between your devices and your machine — nothing about it reaches us. Details in the <a href="{{ route('legal.show', 'server-privacy') }}">Server Privacy</a> and per-app privacy documents.</p>
</x-layouts.legal>
