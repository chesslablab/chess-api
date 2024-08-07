FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    unzip \
    zip \
    libpng-dev \
    ffmpeg \
    stockfish

RUN docker-php-ext-install mysqli pdo_mysql gd

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /usr/share/nginx/chess-api

COPY composer.json composer.json

COPY composer.lock composer.lock

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install \
    --no-interaction \
    --no-scripts

# By default, Composer runs as root inside the container.
# This can lead to permission issues on your host filesystem.

RUN chown -R 1000:1000 vendor

RUN chmod -R 775 vendor
