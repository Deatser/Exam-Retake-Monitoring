FROM php:7.4-apache

RUN apt-get update && apt-get install -y python3

COPY . /var/www/html/
RUN docker-php-ext-install mysqli

