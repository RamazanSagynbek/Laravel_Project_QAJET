#!/bin/bash
set -e

# Ensure required directories exist (Render has no persistent storage)
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p bootstrap/cache

echo "🔗 Linking storage..."
php artisan storage:link 2>/dev/null || true

echo "🗄️ Running migrations..."
php artisan migrate --force

if [ "$RUN_SEEDER" = "true" ]; then
    echo "🌱 Running seeders..."
    php artisan db:seed --force
fi

echo "🚀 Starting server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
