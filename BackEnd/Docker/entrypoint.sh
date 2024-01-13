#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi


role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    php artisan migrate:fresh --seed
    php artisan import:script_carreras
    php artisan storage:link
    php artisan key:generate
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan serve --host=0.0.0.0 --port=$APP_PORT
    exec docker-php-entrypoint "$@"
fi