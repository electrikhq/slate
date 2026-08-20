#!/usr/bin/env bash
# Create a path-linked Laravel consumer app and wire a critical-components smoke page.
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SANDBOX="${CONSUMER_SANDBOX:-$ROOT/.ci-sandbox}"

echo "==> Consumer sandbox: $SANDBOX"
rm -rf "$SANDBOX"

echo "==> Creating Laravel app"
composer create-project laravel/laravel "$SANDBOX" --no-interaction --prefer-dist

cd "$SANDBOX"

echo "==> Path-linking electrik/slate"
php -r '
$composerPath = $argv[1] . "/composer.json";
$json = json_decode(file_get_contents($composerPath), true);
$json["repositories"] = [[
    "type" => "path",
    "url" => $argv[2],
    "options" => ["symlink" => true],
]];
$json["require"]["electrik/slate"] = "@dev";
file_put_contents($composerPath, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
' "$SANDBOX" "$ROOT"

composer update electrik/slate --no-interaction

echo "==> Wiring CSS"
if ! grep -q "electrik/slate/resources/css/slate.css" resources/css/app.css; then
  perl -0pi -e "s/@import 'tailwindcss';/@import 'tailwindcss';\n\@import '..\/..\/vendor\/electrik\/slate\/resources\/css\/slate.css';/" resources/css/app.css
fi

echo "==> Copying smoke fixtures"
mkdir -p tests/Feature resources/views
cp "$ROOT/tests/fixtures/consumer/slate-critical.blade.php" resources/views/slate-critical.blade.php
cp "$ROOT/tests/fixtures/consumer/slate-form-matrix.blade.php" resources/views/slate-form-matrix.blade.php
cp "$ROOT/tests/fixtures/consumer/SlateCriticalSmokeTest.php" tests/Feature/SlateCriticalSmokeTest.php

cat > routes/web.php << 'EOF'
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('slate-critical'));
Route::get('/slate-critical', fn () => view('slate-critical'));
Route::get('/slate-form-matrix', fn () => view('slate-form-matrix'));
EOF

cp -n .env.example .env 2>/dev/null || true
php artisan key:generate --force

echo "==> Frontend build"
npm install
npm run build

echo "==> Done. Run: cd \"$SANDBOX\" && php artisan test --filter=SlateCriticalSmoke"
