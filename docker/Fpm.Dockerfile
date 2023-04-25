FROM php:8.1-fpm

RUN apt-get update

WORKDIR /var/www/laravel-docker


RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

ENTRYPOINT ["docker/run.sh"]

CMD ["php-fpm"]




