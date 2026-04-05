#!/bin/sh

echo "Running post-deployment tasks..."

# Generate app key if not set
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link

echo "Deployment tasks completed!"
