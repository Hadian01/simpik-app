#!/bin/sh

echo "🚀 Starting SIMPIK..."

# Check if APP_KEY is set, if not generate one
if [ -z "$APP_KEY" ]; then
    echo "⚠️  APP_KEY not found, generating new key..."
    php artisan key:generate --force
else
    echo "✅ APP_KEY already set"
fi

# Cache optimization
echo "📦 Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start server
echo "🌐 Starting server on port ${PORT:-8080}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
