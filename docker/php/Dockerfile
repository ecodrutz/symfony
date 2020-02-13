FROM php:7.4-fpm

ARG PHP_USER
ENV PHP_USER=$PHP_USER

RUN apt-get update && apt-get install -yq --no-install-recommends git zip unzip libzip-dev libpng-dev libjpeg-dev libicu-dev

RUN docker-php-ext-configure gd --with-jpeg
RUN docker-php-ext-configure intl

RUN docker-php-ext-install opcache pdo_mysql gd intl \
    && pecl install apcu xdebug \
    && docker-php-ext-enable apcu xdebug

COPY install_composer.sh /tmp
RUN chmod +x /tmp/install_composer.sh && sh /tmp/install_composer.sh && rm /tmp/install_composer.sh
COPY config/custom_config.ini /usr/local/etc/php/conf.d
ENV PATH=$PATH:/var/www/application/vendor/bin:bin
ENV PATH="$HOME/.symfony/bin:$PATH"

WORKDIR /var/www/application
