#!/bin/bash
set -e

echo "🔗 Linking storage..."
php artisan storage:link 2>/dev/null || true

echo "⚡ Caching config, routes, views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🗄️ Running migrations..."
php artisan migrate --force

if [ "$RUN_SEEDER" = "true" ]; then
    echo "🌱 Running seeders..."
    php artisan db:seed --force
fi

echo "🚀 Starting server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
