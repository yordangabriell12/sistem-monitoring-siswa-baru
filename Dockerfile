FROM php:8.2-fpm

RUN apt-get update \
 && apt-get install -y libzip-dev zip unzip git \
 && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www

COPY . /var/www
RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer \
 && composer install --no-dev --optimize-autoloader \
 && php artisan key:generate

EXPOSE 9000
CMD ["php-fpm", "--nodaemonize"]
