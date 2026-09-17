# SoundChex Landing Page — Plan

The marketing site for SoundChex: a landing page plus the doc and policy pages
it links to. This plan covers positioning, brand, page structure, the
supporting pages that must exist before launch, and a recommended build.

Everything factual below is drawn from the app repo (`SoundChex App/README.md`,
`resources/css/tokens.css`, `docs/`, `Documentation & Planning/`). Where the
site needs something that does not exist yet, it is marked **GAP**.

---

## Positioning

**One line:** A self-hosted media library for music, films, TV and books — one
catalogue, one player, on every device you own.

**The promise:** Your files stay yours. SoundChex runs on your own machine,
uploads nothing, and the only thing between you and your library is a network
you control.

**The model (three tiers, one product):**

1. **Free, forever.** The app and server are MIT-licensed, source public at
   `github.com/tripsittr/SoundChex`. No feature gates.
2. **Donations** keep it that way (platform choice below).
3. **SCNet — the SoundChex Network** *(name decided)* — an optional paid subscription for
   remote access through our hosted relay, the way Emby Connect works: sign in
   from anywhere without opening ports or running your own tunnel. Anyone who
   prefers their own hosting (Tailscale, reverse proxy, VPS, anything) uses it
   free — the subscription buys convenience, never capability.

That framing matters on the page: the paid tier must never read as a paywall.
"Free and open source. Pay only if you want us to handle the networking."

---

## Brand

Dark-first, matching the app itself.

### Colors (from `resources/css/tokens.css` — the app's shared tokens)

| Token | Value | Use on the site |
| --- | --- | --- |
| `--sc-base-900` | `#08080b` | Page background (near-black, slightly blue — never pure #000) |
| `--sc-base-800` | `#0f0f14` | Section alternation |
| `--sc-base-700` | `#16161d` | Cards |
| `--sc-base-600` | `#1f1f28` | Card borders, hover states |
| `--sc-base-500` | `#2a2a35` | Dividers |
| `--sc-ink-100` | `#f4f4f5` | Headlines, body on dark |
| `--sc-ink-300` | `#b8b8c0` | Secondary text |
| `--sc-ink-500` | `#8a8a96` | Captions, footer |
| `--sc-accent` | `#d95145` | CTAs, links — sampled from the wordmark itself (the app token `#e11d3a` never matched the logo) |
| `--sc-accent-hot` | `#ef6555` | Hover/active accent |

Motion easing: `cubic-bezier(0.16, 1, 0.3, 1)` (`--sc-ease-out-soft`).

### Typography

**Figtree** (Google Fonts), falling back to system sans — same as the app
(`app.css` / `media-center.css`). Headlines heavy (700–800), body 400.

### Logos (copied into `assets/`)

| File | What it is |
| --- | --- |
| `assets/logo-light-on-dark.png` | Wordmark for dark backgrounds — primary for this site |
| `assets/logo-dark-on-light.png` | Wordmark for light backgrounds (docs pages if they go light, social cards) |
| `assets/favicon.ico` | Favicon, from the app |
| `assets/app-icon.png` / `app-icon-128.png` | Square app icon (touch icons, OG image element) |

The wordmark is lowercase "soundchex" in accent red with headphones forming
the "n" and a waveform underline. Don't recolor it; give it room.

**GAP:** need SVG versions of the wordmark for crisp rendering, and a proper
1200×630 Open Graph image.

---

## Landing page structure

Single long-scroll page. Order:

### 1. Hero
- Wordmark, then headline. Working copy:
  **"Your media. Your machine. Every device."**
  Sub: "SoundChex is a free, open-source library for your music, films, TV
  and books — one catalogue, one player, self-hosted so your files never
  leave home."
- Primary CTA: **Download** (platform-detected). Secondary: **View on GitHub**
  (with live star count).
- Visual: app screenshot inside a device frame on the dark ground.
  **GAP:** need clean library screenshots (macOS + iPhone).

### 2. Platform row
Six targets: macOS, iOS, iPadOS, Windows, Linux, Android. **Be honest** —
only macOS and iOS are built today; the rest get "coming soon" badges, not
dead download links. (Source: `docs/BuildingOnEachPlatform.md`.)

### 3. Features (six cards, straight from the README)
- **One catalogue, four media types** — music, films, TV and books share a
  schema, a search box and a player.
- **Metadata that fills itself in** — nine sources (TMDB, MusicBrainz,
  AcoustID, Open Library, iTunes, Spotify, OpenSubtitles, file tags), every
  run snapshotted and reversible.
- **Search that reaches inside things** — one query across titles, cast, film
  dialogue and the text of books; hits jump to the moment or the page.
- **Reading and watching, not just listening** — EPUB/PDF/CBZ with highlights
  and OCR; video with hardware transcoding, captions, skip markers.
- **Works offline** — the catalogue mirrors to the device; downloads survive
  the app closing.
- **Plays well with others** — files organised the way Plex, Jellyfin and
  Emby already read (`Artist/Album/`, `Title (Year)/`, `Series/Season 01/`).

### 4. Profiles strip
Per-person history, resume points, watchlists, and a kids mode that caps
ratings across browsing, search and direct links.

### 5. Pricing — "Free. Actually free."
Two columns, not three (donations are not a tier):

| | **Self-hosted** | **SoundChex Connect** |
| --- | --- | --- |
| Price | Free forever | $ /mo *(price TBD)* |
| The app, every feature | ✓ | ✓ |
| Remote access | Bring your own (Tailscale, reverse proxy, VPN…) | Through our relay — no ports, no tunnel setup |
| Source code | MIT, on GitHub | same |

Under the table: relay honesty from the README — a direct route is always
preferred and the app races every address it knows; the relay is the
works-from-anywhere fallback. **GAP:** Connect doesn't exist as a product yet
— name, price, and billing (Stripe?) all TBD. The landing page can launch
with this column as "coming soon" + email capture.

### 6. Open source + donations
- "MIT licensed. The code is public, the roadmap is public, the issues are
  public." GitHub CTA repeated.
- Donation ask, one sentence, one button. Platform recommendation:
  **GitHub Sponsors** as primary (zero fees, meets the audience where the
  code is) plus **Ko-fi** for one-off, no-account donations. Open Collective
  is the alternative if fiscal transparency under Tripsittr LLC matters more
  than fees. **GAP:** decide and set up; needs a `FUNDING.yml` in the repo too.

### 7. Get-started strip
The six-line quickstart from the README (`git clone` → `php artisan serve`)
in a code block, with "Full install guide →" linking into docs. Shows the
self-host path is real, not buried.

### 8. Footer
Logo, tagline, and the full link tree (below). Plus the license note worth
keeping verbatim: *"Your media is not ours and not our business. SoundChex is
a library for files you already have; it neither acquires them nor helps you
to."* (Adapted from the README licence section — review wording.)

---

## Documentation pages the site must link to

Nav: **Docs** dropdown or a `/docs` index. Five sections, mapped to what
exists today:

| Site page | Source material | State |
| --- | --- | --- |
| **Install** | README quickstart; `docs/SettingUpOnWindows.md` (incl. the cURL-60 cert fix); `docs/BuildingOnEachPlatform.md`; per-platform downloads | Windows + build docs exist; macOS/Linux install page is **GAP** |
| **Setup** | README: watch folders, `library:scan`, `storage:link` trap, queue + scheduler workers, launchd plists | Exists in README form; needs a friendlier walkthrough |
| **Integrations** | Metadata sources and which need API keys (TMDB, AcoustID, Spotify, OpenSubtitles — entered in Admin → Metadata sources); Plex/Jellyfin/Emby-compatible file layout | Facts exist; page is **GAP** |
| **Configuration** | Remote access options (`Documentation & Planning/RemoteAccess.md`), moving a server (`docs/MovingAServer.md`), backups | Internal docs exist; need end-user rewrites — internal planning docs should not be linked raw |
| **Customization** | Profiles, kids mode, admin/library settings | **GAP** — nothing user-facing written |

Decision to make: docs living on the site vs. linking into the GitHub repo's
`docs/`. Recommendation: start by linking to GitHub (zero duplication, always
current), migrate to on-site docs once the site has a static-site generator
in place.

## Policy pages (all GAP — none exist yet)

Required before Connect takes money; the first two before launch at all:

- **Privacy Policy** — easy story to tell: self-hosted, nothing uploaded, no
  analytics (confirm what the site itself uses before writing).
- **Terms of Use** — app is MIT; terms mostly cover the website + Connect.
- **Connect subscriber terms** — billing, cancellation, refunds, uptime
  expectations. Needed only when Connect launches.
- **Acceptable Use / DMCA agent** — required for the relay: our
  infrastructure carries users' streams. Tripsittr LLC should register a
  DMCA agent with the Copyright Office before Connect goes live.
- Footer also links: trademark notice (SoundChex™ — filing on record,
  6-11-26), contact, GitHub issues as the support channel.

These need legal review — draft them, don't ship them straight.

---

## Build recommendation

- **Stack (decided):** Laravel + Tailwind v4, Livewire where interactivity
  earns it. Same stack as the app itself (Laravel 13, Blade, Tailwind v4), so
  `tokens.css`, the Figtree setup and Blade conventions carry over verbatim,
  and any contributor to one codebase can work on the other.
  - The landing page itself is static Blade — no Livewire needed there.
  - Livewire earns its place on: the Connect "coming soon" email capture,
    the contact form, and later the Connect signup/account area.
  - When Connect launches, **Laravel Cashier (Stripe)** is the natural
    subscription-billing layer — a strong reason this stack choice pays off.
  - Docs pages: Blade + a markdown renderer (e.g. `spatie/laravel-markdown`)
    reading the same `.md` files, so docs stay markdown-first.
- **Hosting:** needs PHP now — a small VPS (Hetzner/DigitalOcean) with
  Laravel Forge, or Laravel Cloud. Cache aggressively (`spatie/laravel-responsecache`
  or full-page CDN caching) so the mostly-static site stays fast and cheap.
  **GAP:** confirm the domain (soundchex.com?).
- **This folder** becomes the site repo: a fresh Laravel app with `assets/`
  (already populated) moved into `resources/images/` + `public/`. Keep it a
  separate git repo from the app.
- **Analytics:** none, or something cookieless (Plausible/GoatCounter) — "we
  don't track you" is part of the pitch and keeps the privacy policy short.
- Per app-repo convention: no AI attribution artifacts in anything published.

## Launch checklist (ordered)

Built 2026-09-17: Laravel 13 + Tailwind v4 + Livewire 4 scaffolded in this
folder; landing page (`/`), docs map (`/docs`), draft policies (`/privacy`,
`/terms`); SCNet waitlist email capture backed by `waitlist_signups`
(SQLite); feature + Livewire tests passing. Subscription tier named
**SCNet — the SoundChex Network**.

Still open:

1. Donation platform: page currently links GitHub Sponsors
   (`github.com/sponsors/tripsittr`) — activate Sponsors (or swap the link)
   and add `FUNDING.yml` to the app repo.
2. Real screenshots (macOS library view, iPhone player) for the hero.
3. SVG wordmark + proper 1200×630 OG image.
4. Confirm domain and hosting (Forge/VPS or Laravel Cloud); `git init` this
   folder as its own repo.
5. Legal review of the Privacy + Terms drafts (both pages carry a draft
   badge until then).
6. Write the in-progress docs (Integrations, Configuration, Customization
   guides) — the docs page marks them honestly.
7. SCNet productization: pricing, Cashier/Stripe billing, subscriber terms,
   DMCA agent registration — before taking money.
