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

php artisan migrate

# Start PHP-FPM
exec php-fpm
