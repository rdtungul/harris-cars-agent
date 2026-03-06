#!/bin/bash
set -e

cd /var/www/html

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
