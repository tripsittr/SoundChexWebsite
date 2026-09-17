# 008 — AGPLv3 licence (W-20)

*2026-09-17.*

## Done

- Added `LICENSE` — the full official GNU AGPLv3 text (verified against the
  canonical FSF SHA-256 `0d96a4ff…abcb0`; contains §13, Remote Network
  Interaction).
- SPDX header (`SPDX-License-Identifier: AGPL-3.0-or-later` + copyright) on every
  first-party source file (31 PHP/JS). Pint clean; all PHP lints.
- Licence metadata: `composer.json` MIT → `AGPL-3.0-or-later`; `package.json`
  gains the same identifier.
- README licence section rewritten from the stock-Laravel MIT text to state the
  project is AGPLv3 (Laravel-the-framework noted as separately MIT), including
  the §13 network-source obligation.

## Why

SoundChex is AGPLv3 across all platforms (app/desktop, iOS, and this website).
The site is a Laravel app served to users over a network, so AGPL's network-use
copyleft applies to it as to the rest.
