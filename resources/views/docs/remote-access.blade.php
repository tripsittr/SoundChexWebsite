<x-layouts.docs title="Remote access">
    <h1>Remote access</h1>
    <p class="doc-lead">
        SoundChex runs on one machine in your home. Reaching it from a phone on mobile data is a
        networking problem, not an application one — nothing in the app changes. Pick one of the
        options below, or wait for SCNet to do it for you.
    </p>
    <div class="doc-note">
        <p><strong>First, confirm it works at home:</strong> open
        <code>http://&lt;your-server-ip&gt;:8000/app</code> from another device on your own network.
        If that fails, remote access won't help yet — check <code>APP_URL</code> (port included) and
        the firewall.</p>
    </div>

    <h2>How the apps choose a route</h2>
    <p>
        The apps race every address they know — LAN, tailnet, tunnel, relay — and take the fastest
        that answers, re-checking every thirty seconds and whenever the device wakes. A relay ranks
        last however well it measures: it works from anywhere, and it's roughly twenty times slower
        than a direct route. So adding remote access never slows you down at home.
    </p>

    <h2>Option 1 — Cloudflare Tunnel (recommended)</h2>
    <p>
        Free, needs a domain you own, and works even if your ISP blocks inbound ports or changes your
        IP. No port forwarding.
    </p>
    <pre><code>brew install cloudflared            # or the package for your OS

cloudflared tunnel login
cloudflared tunnel create soundchex
cloudflared tunnel route dns soundchex media.yourdomain.com</code></pre>
    <p><code>~/.cloudflared/config.yml</code>:</p>
    <pre><code>tunnel: soundchex
credentials-file: /Users/YOU/.cloudflared/&lt;tunnel-id&gt;.json

ingress:
  - hostname: media.yourdomain.com
    service: http://localhost:80
  - service: http_status:404</code></pre>
    <p>Run it as a service, then point the app at its public name:</p>
    <pre><code>sudo cloudflared service install</code></pre>
    <pre><code># .env
APP_URL=https://media.yourdomain.com
APP_ENV=production</code></pre>
    <p>Then <code>php artisan config:clear</code>.</p>
    <div class="doc-warn">
        <p><strong><code>APP_ENV=production</code> matters:</strong> it turns on HTTPS URL generation
        and hides detailed error pages from the internet. And remember a tunnel puts your login page
        on the public internet — login is rate-limited (5 attempts per minute, per IP <em>and</em> per
        account), but if you'd rather nobody outside the household can even reach it, put Cloudflare
        Access in front of the hostname for an email-verification step before any request touches
        your server.</p>
    </div>

    <h2>Option 2 — Tailscale (most private)</h2>
    <p>
        Free for personal use, no domain, no public exposure at all. The trade-off: every device you
        use must have Tailscale installed — excellent for family, awkward for guests.
    </p>
    <pre><code>brew install tailscale
sudo tailscale up</code></pre>
    <p>
        Install Tailscale on your phone, sign in with the same account, and open
        <code>http://&lt;tailscale-ip&gt;/app</code>. For a real hostname and automatic HTTPS:
    </p>
    <pre><code>tailscale cert &lt;machine&gt;.&lt;tailnet&gt;.ts.net
tailscale serve https / http://localhost:80</code></pre>
    <p>Then set <code>APP_URL</code> to that <code>https://…ts.net</code> address.</p>

    <h2>Option 3 — VPS reverse proxy</h2>
    <p>
        A small VPS holds a stable public IP and forwards over WireGuard to your home server. Worth
        it only if your home connection is unreliable; costs a few dollars a month and takes about
        half a day. The two options above are free and faster to set up.
    </p>

    <h2>Option 4 — SCNet <span class="text-sm font-medium" style="color: var(--sc-ink-500)">(coming soon)</span></h2>
    <p>
        The SoundChex Network: sign in from anywhere through our hosted relay — no ports, no tunnels,
        no domain, no setup. A subscription that buys convenience, never capability: direct routes
        are still always preferred when one exists.
        <a href="{{ route('home') }}#pricing">Join the waitlist</a>.
    </p>

    <h2>After it's reachable</h2>
    <ul>
        <li><strong>Install it on your phone</strong> — open the library in the phone's browser and use <em>Add to Home Screen</em>. SoundChex ships a web app manifest, so it launches without browser chrome, with your artwork as the icon.</li>
        <li><strong>Keep the queue running</strong> — enrichment and downloads are background jobs; see <a href="{{ route('docs.show', 'workers') }}">Background workers</a>.</li>
    </ul>
</x-layouts.docs>
