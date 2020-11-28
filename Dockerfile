FROM php:7.2-apache

RUN docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql

COPY src/ /var/www/html/

COPY php.ini $PHP_INI_DIR/php.ini