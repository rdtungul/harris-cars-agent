#!/bin/bash
set -e

cd /var/www/html

echo "==> Creating .env from environment variables..."
# On Render there is no .env file — build one from the process environment
# so Laravel artisan commands can read it.
if [ ! -f .env ]; then
    printenv | grep -E '^(APP_|DB_|CACHE_|SESSION_|REDIS_|MAIL_|LOG_|QUEUE_|BROADCAST_|FILESYSTEM_|AWS_|MIX_|VITE_)' \
        | sed 's/=\(.*\)/="\1"/' \
        > .env
    # Ensure APP_ENV and APP_DEBUG have safe defaults if missing
    grep -q '^APP_ENV=' .env  || echo 'APP_ENV="production"' >> .env
    grep -q '^APP_DEBUG=' .env || echo 'APP_DEBUG="false"'   >> .env
fi

echo "==> Clearing config cache..."
php artisan config:clear

echo "==> Generating app key if not set..."
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Linking storage..."
php artisan storage:link --force 2>/dev/null || true

echo "==> Caching config, routes, views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
