FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev curl git \
    && docker-php-ext-install pdo pdo_mysql zip

RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 600" >> /usr/local/etc/php/conf.d/uploads.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html