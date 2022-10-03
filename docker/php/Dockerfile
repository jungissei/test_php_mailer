FROM php:7.2-apache AS builder

RUN apt-get update && docker-php-ext-install pdo_mysql mysqli mbstring unzip \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 80
