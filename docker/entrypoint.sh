#!/bin/sh

# Ensure Composer dependencies are installed
if [ ! -f /var/www/composer-installed ]; then
    echo "Running composer install..."
    composer install --optimize-autoloader --no-interaction --no-progress
    cp .env.example .env
    php artisan key:generate
    php artisan test
    npm install
    npm run build

    touch /var/www/composer-installed
else
    echo "Composer dependencies already installed."
fi

if [ "$EXECUTE_QUEUE_WORK" = "true" ]; then
    php artisan queue:work --timeout=0
else
    php artisan migrate
fi

# Start PHP-FPM
exec php-fpm
