#!/bin/sh

cd /var/www/laravel-docker/
php artisan cache:clear
php artisan migrate:fresh --seed
php artisan schedule:run

exec "$@"
#/usr/bin/supervisord -n -c /etc/supervisord.conf
