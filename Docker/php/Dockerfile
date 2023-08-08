FROM php:8.0.0rc1-fpm

RUN apt-get update && apt-get install -y git

RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www