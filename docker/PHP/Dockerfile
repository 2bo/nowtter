FROM php:5.6-apache

RUN docker-php-ext-install pdo_mysql mbstring

RUN mkdir -p /var/www/nowtter

COPY php.ini $PHP_INI_DIR/php.ini

COPY nowtter.localhost.conf /etc/apache2/sites-available
RUN a2ensite nowtter.localhost.conf

RUN pecl install xdebug-2.4.0
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN echo "127.0.0.1         nowtter.localhost" >> /etc/hosts
