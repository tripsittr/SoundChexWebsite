# AGENTS.md — SoundChex Website

The source of truth for how this repository is built and worked on. It mirrors
the conventions of the app repository (`../SoundChex App/AGENTS.md`) so anyone
— human or agent — can move between the two without relearning the workflow.

## What this repository is

The SoundChex marketing site: landing page, download hub, documentation hub,
and the legal suite. **Laravel 13 + Tailwind v4 + Livewire 4**, served locally
by Herd at `https://soundchex.test`. It is deliberately mostly-static: SQLite
holds exactly one table (`waitlist_signups`), and Livewire exists for exactly
one component (the SCNet waitlist form).

| Where | What |
| --- | --- |
| `resources/views/home.blade.php` | The landing page |
| `resources/views/download.blade.php` | Download hub — all installer links route through here |
| `resources/views/docs/*.blade.php` | One file per docs page; slug-routed via `/docs/{slug}` with a view-exists whitelist |
| `resources/views/components/docs/sidebar.blade.php` | The docs tree — add a page here and in `docs/`, and it is routed, navigable and tested |
| `resources/views/legal/*.blade.php` | One file per legal document, same slug pattern under `/legal/{slug}` |
| `resources/views/components/legal/` | Legal sidebar + the shared per-app terms/privacy components |
| `resources/css/tokens.css` | Brand tokens, copied from the app repo. **Site accent is `#d95145`** — sampled from the wordmark; the app repo still carries `#e11d3a` |
| `public/legal-pdf/` | Every legal document as a committed PDF |
| `scripts/build-legal-pdfs.sh` | Regenerates those PDFs from the live pages |
|  `Documentation & Planning/LandingPagePlan.md` | The original plan and the remaining launch checklist |

`CLAUDE.md` carries the Laravel Boost guidelines (Pint, `make:` commands,
project skills in `.claude/skills/`) — follow them.

## The workflow (same as the app repo)

- **Start at `Documentation & Planning/Status.md`**, then the issue you're
  working. One thing at a time, finished before the next.
- **Everything gets an issue** in the admin **Tracker** (this repo's own
  Filament panel, `/admin` → Tracker / Board) *before* the work starts —
  features, fixes, content changes alike, **not** in `Documentation &
  Planning/Issues.md` (now a pointer). Add it in the panel or with
  `php artisan track:issue`. Website work is `platform=web`,
  `repo=SoundChexWebsite`; historical W-NN ids live on the item's `ref`. Advance
  the item's `status` as work moves (Planned → In progress → Shipped/Done, or
  Deferred) — drag the card on the Board, or from the console
  `php artisan track:move <id…> --to=<status>` (`--note` appends a dated line).
  Nothing is deleted.
- **Every change gets a changelog** in `changelog/NNN-name.md`, written when
  the change lands. Say what is still broken as well as what was done.
- **Everything reaches `main` through a pull request** (the repo has a GitHub
  remote now), each carrying its tracker update and changelog.
- **No AI artifacts** in commits or anything published (project-wide rule).

## Definition of done for any change

1. Tracker item logged/advanced; changelog entry written.
2. `vendor/bin/pint --dirty --format agent` after PHP edits.
3. `php artisan test --compact` passes.
4. `npm run build` after any CSS/JS change — **Tailwind v4 only compiles
   utilities it has seen, so a new class does nothing until the build runs.**
5. If a legal page changed: `./scripts/build-legal-pdfs.sh` and commit the
   regenerated PDFs with the page — the files must never drift from the site.
6. If the change affects claims the site makes (platform availability,
   features, install steps, data handling): check the **cross-repo sync**
   section below.

## Cross-repo sync — how the two agents stay on task

The app repo is the source of truth for what the product *does*; this repo is
the source of truth for what we *say* it does. Neither change is done until
both agree.

- **App-side changes that must reach this site:** a platform actually shipping
  (flip the landing-page platform row, the `/download` rows, the app docs
  badge, and the legal page's "published ahead" banner — together); install or
  setup steps changing (`/docs` pages); any new network behaviour or data
  handling (the legal suite commits us to updating the document *first* and
  making it opt-in).
- **Site-side changes the app repo should know about:** promises added to the
  legal suite (zero telemetry, downloads in app-private storage, "Data Not
  Collected" store labels) are product constraints — treat them as spec.
- The mechanism is the **Tracker**: all repos' work lives in one `items` table
  (this repo's admin panel). When a change here needs app-side work, add a
  tracker item with the right `platform`/`repo`, and reference the paired item's
  `ref` in the description. One board shows every platform's work, so there is no
  cross-file syncing any more.

## Content rules

- **Honesty is the voice.** Unbuilt platforms say "coming soon", untested
  instructions say so, and the docs keep the app repo's habit of naming the
  silent failures. Never let marketing copy promise what Status.md denies.
- **Zero tracking is a commitment, not a default** — the legal suite is
  specific about it. No analytics, no third-party requests, no non-essential
  cookies. Anything that would change that changes the legal pages first.
- Facts about the product come from the app repo's README and docs — link or
  restate them, don't invent them.
- Design: brand tokens only (`bg-base-*`, `text-ink-*`, `text-accent`), Figtree
  via the bunny Vite plugin, dark-first. The wordmark is not recolored.
