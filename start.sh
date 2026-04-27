#!/bin/bash

# Create SQLite database file if it's configured and doesn't exist
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    DB_PATH=${DB_DATABASE:-/app/database/database.sqlite}
    mkdir -p $(dirname $DB_PATH)
    if [ ! -f "$DB_PATH" ]; then
        echo "Creating SQLite database at $DB_PATH"
        touch $DB_PATH
    fi
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Seed database if it's empty
echo "Checking if database needs seeding..."
php artisan tinker --execute="if(App\Models\Product::count() === 0) { Artisan::call('db:seed', ['--force' => true]); echo 'Database seeded'; } else { echo 'Database already has data'; }"

# Clear cache and optimize for production
echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
echo "Starting application..."
php -S 0.0.0.0:$PORT -t public
