FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
