# Issues — moved to the admin tracker

Issue and to-do tracking for **every SoundChex repo** now lives in the database,
managed from the landing site's admin panel — not in this file.

- **Admin panel:** `/admin` on the SoundChex website → **Tracker**. Create, edit,
  filter (by platform, status, type, repo) and publish items. Flip an item's
  **published** toggle to promote it to the public [roadmap](../resources/views/roadmap.blade.php).
- **From the console:** `php artisan track:issue` (in the website repo) —
  interactive, or with flags: `--platform --type --status --repo --ref --publish`.

The historical contents of the per-repo `Issues.md` files were imported into the
tracker (keyed on their original `S-NN` / `IOS-NN` / `W-NN` / `A-NN` / `TV-NN` /
`R-NN` references), and are reproducible from
`SoundChex Website/database/seeders/data/items.json`. Nothing was lost.

> **Workflow:** log new work as a tracker item (panel or `track:issue`) *before*
> starting it, the same discipline the Markdown tracker enforced — just in the
> database now.
