#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-interaction --prefer-dist --optimize-autoloader

# Compile assets using Vite
npm install
npm run build

# Run database migrations
php artisan migrate --force
