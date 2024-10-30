#!/bin/sh

# Ensure Composer dependencies are installed
if [ ! -f /var/www/composer-installed ]; then
    echo "Running composer install..."
    composer install --optimize-autoloader --no-interaction --no-progress
    php artisan key:generate
    php artisan migrate --seed
    php artisan test
    npm install
    npm run build
else
    echo "Composer dependencies already installed."
fi

# Start PHP-FPM
exec php-fpm
