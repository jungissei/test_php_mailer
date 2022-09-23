FROM php:7.2-apache
RUN apt-get update && docker-php-ext-install pdo_mysql mysqli mbstring \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

EXPOSE 80
