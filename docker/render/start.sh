#!/bin/bash
set -e

cd /var/www/html

echo "==> Removing any stale bootstrap cache..."
rm -f bootstrap/cache/config.php \
      bootstrap/cache/routes*.php \
      bootstrap/cache/services.php \
      bootstrap/cache/packages.php

echo "==> Building .env from Render environment variables..."
# Always overwrite .env so Render-injected vars win over anything in the image.
cat > .env <<EOF
APP_NAME="${APP_NAME:-Harris Cars Service Center}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY:-}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL:-http://localhost}"

LOG_CHANNEL="${LOG_CHANNEL:-stderr}"
LOG_LEVEL="${LOG_LEVEL:-error}"

DB_CONNECTION="${DB_CONNECTION:-pgsql}"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-5432}"
DB_DATABASE="${DB_DATABASE:-harris_cars}"
DB_USERNAME="${DB_USERNAME:-harris_cars_user}"
DB_PASSWORD="${DB_PASSWORD:-}"

CACHE_STORE="${CACHE_STORE:-file}"
SESSION_DRIVER="${SESSION_DRIVER:-file}"
SESSION_LIFETIME="${SESSION_LIFETIME:-120}"
SESSION_SECURE_COOKIE="${SESSION_SECURE_COOKIE:-true}"

QUEUE_CONNECTION="${QUEUE_CONNECTION:-sync}"

MAIL_MAILER="${MAIL_MAILER:-log}"
MAIL_FROM_ADDRESS="${MAIL_FROM_ADDRESS:-hello@example.com}"
MAIL_FROM_NAME="${MAIL_FROM_NAME:-Harris Cars}"

FILESYSTEM_DISK="${FILESYSTEM_DISK:-local}"
EOF

echo "==> DB settings:"
grep -E '^DB_' .env

echo "==> Generating app key if not set..."
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Seeding admin user..."
php artisan db:seed --class=UserSeeder --force

echo "==> Linking storage..."
php artisan storage:link --force 2>/dev/null || true

echo "==> Caching config, routes, views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
