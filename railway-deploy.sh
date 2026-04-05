#!/bin/sh

echo "Running post-deployment tasks..."

# Run migrations
php artisan migrate --force

# Clear all cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Create storage link (ignore if exists)
php artisan storage:link || true

echo "Deployment tasks completed!"
