#!/usr/bin/env bash
set -euo pipefail

PLUGIN_SLUG="P1_PLUGIN_SLUG"
VERSION=$(grep "Version:" *.php | awk '{print $2}')

mkdir -p dist
ZIP="dist/${PLUGIN_SLUG}-${VERSION}.zip"
rm -f "$ZIP"

zip -r "$ZIP" .   -x "dist/*"   -x ".git/*"   -x ".github/*"

echo "Built $ZIP"
