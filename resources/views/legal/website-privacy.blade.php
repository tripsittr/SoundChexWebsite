<x-layouts.legal title="Website Privacy Policy">
    <h1>Website Privacy Policy</h1>
    <p class="doc-lead">This policy covers this website only. The server and the apps have their own privacy documents — see the <a href="{{ route('legal') }}">legal home</a> — and they are even shorter, because those collect nothing at all.</p>

    <h2>The whole policy, in three sentences</h2>
    <div class="doc-note">
        <p><strong>This site runs zero trackers and zero analytics, sets only the cookies it technically cannot work without, and embeds no third-party services in its pages.</strong> Its pages load nothing from anyone but us; the only time your browser reaches another service is when <em>you</em> click a link we clearly label — a download or a source link that sends you to GitHub. The only personal data it can ever hold is an email address you volunteer to the SCNet waitlist. We do not sell, share, rent or enrich anything, because there is nothing to sell, share, rent or enrich.</p>
    </div>

    <h2>1. Data we collect automatically: none</h2>
    <ul>
        <li><strong>No analytics.</strong> No Google Analytics, no Plausible, no self-hosted analytics, nothing. We do not count you, fingerprint you, or measure you.</li>
        <li><strong>No trackers, no ads, no pixels, no beacons.</strong></li>
        <li><strong>No third-party requests from our pages.</strong> Fonts, styles, scripts and images are all served from this domain — our pages embed no third-party trackers, CDNs or widgets. The one exception is a link you choose to click: our download buttons and "source" links point to <a href="https://github.com/tripsittr/SoundChex">GitHub</a>, so following one sends your browser to GitHub, which has its own <a href="https://docs.github.com/en/site-policy/privacy-policies/github-general-privacy-statement">privacy statement</a>. We host the software's releases there; we do not control what GitHub logs.</li>
        <li><strong>Server logs.</strong> Like any web server, ours writes technical logs (requested URL, timestamp, IP address) for security and debugging. They are used for nothing else, correlated with nothing, and routinely deleted. They never leave our infrastructure.</li>
    </ul>

    <h2>2. Data you can volunteer: one email address</h2>
    <p>If you join the SCNet waitlist, we store:</p>
    <table>
        <tr><th>What</th><th>Why</th><th>How long</th></tr>
        <tr><td>The email address you typed</td><td>To email you when SCNet opens — that is the only use</td><td>Until SCNet launches and the list has served its purpose, or until you ask us to delete it, whichever comes first</td></tr>
    </table>
    <p>No name, no IP attached to the signup, no marketing list, no "partners". To have it removed, open an issue on <a href="https://github.com/tripsittr/SoundChex/issues">GitHub</a> or use the footer contact — deletion is honored without questions.</p>

    <h2>3. Cookies</h2>
    <p>Only strictly necessary, first-party cookies — listed individually in the <a href="{{ route('legal.show', 'cookies') }}">Cookie Policy</a>. There are no tracking cookies, which is why the site shows no cookie banner: there is nothing to consent to.</p>

    <h2>4. Where data lives</h2>
    <p>The waitlist database lives on the server that runs this website, controlled by Tripsittr LLC. It is not synced to third-party marketing tools, CRMs or data warehouses.</p>

    <h2>5. Your rights</h2>
    <p>Access, correction, deletion, portability, objection — ask and it happens. Since the most we can hold about you is one email address, every request reduces to "tell us the address and what you want done with it".</p>

    <h2>6. Children</h2>
    <p>The site collects no data from anyone, children included. The waitlist is intended for people old enough to enter a subscription when SCNet opens.</p>

    <h2>7. Changes</h2>
    <p>Changes move the effective date at the top, with history visible in the site's public repository. We will not weaken the zero-tracking commitment quietly: any change to sections 1–3 would be announced on the site itself.</p>
</x-layouts.legal>
