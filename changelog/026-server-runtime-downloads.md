# 026 — Bundled server runtime downloads (W-33)

*2026-09-18.*

## Done

- **Download page** now has a **Bundled server runtime** section — the
  plug-and-play PHP + php-fpm + Caddy bundle (S-151). Per-OS/arch rows link to
  the `releases/latest/download/soundchex-server-<os>-<arch>.(tar.gz|zip)`
  assets the app repo's `build-server.yml` publishes.
- macOS (Apple silicon) is live; the rest show **Building in CI** until their
  runners publish (static-php-cli can't cross-compile, so each OS builds on its
  own runner).

## Notes

Links point at GitHub Releases `latest`, so the page needs no redeploy as new
runtime versions ship. A note points users at the `.sha256` beside each asset.
Copy/layout only — 17 tests still pass.
