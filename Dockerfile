FROM php:8.3-fpm

WORKDIR /var/www/app

# RUN apk update && apk add \
#     curl \
#     libpng-dev \
#     libxml2-dev \
#     zip \
#     unzip

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

USER root

RUN chmod 777 -R /var/www/app