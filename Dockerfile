FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl \
    && docker-php-ext-install pdo pdo_mysql

RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
