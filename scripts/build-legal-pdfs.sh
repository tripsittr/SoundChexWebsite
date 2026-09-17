#!/usr/bin/env bash
#
# Renders every legal document to PDF under public/legal-pdf/, so the policies
# are stored in the repository (and served) as files, not only as pages.
#
# Rerun after any change to a legal page, then commit the PDFs with it:
#   ./scripts/build-legal-pdfs.sh [base-url]
#
# Requires the site to be reachable (default https://soundchex.test) and npx.
# Uses Chromium's print pipeline, so resources/css/app.css @media print rules
# shape the output.

set -euo pipefail

BASE_URL="${1:-https://soundchex.test}"
OUT_DIR="$(cd "$(dirname "$0")/.." && pwd)/public/legal-pdf"
mkdir -p "$OUT_DIR"

SLUGS=(
    website-terms website-privacy cookies
    server-terms server-privacy
    macos-terms macos-privacy
    windows-terms windows-privacy
    linux-terms linux-privacy
    ios-terms ios-privacy
    ipados-terms ipados-privacy
    android-terms android-privacy
)

for slug in "${SLUGS[@]}"; do
    echo "→ ${slug}.pdf"
    npx playwright pdf --ignore-https-errors "${BASE_URL}/legal/${slug}" "${OUT_DIR}/${slug}.pdf" >/dev/null
done

echo "Done: ${#SLUGS[@]} PDFs in public/legal-pdf/"
