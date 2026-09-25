FROM php:8.5-fpm

ARG PHP_USER
ENV PHP_USER=$PHP_USER

# --- System dependencies -----------------------------------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libicu-dev \
        libzip-dev \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# --- Core PHP extensions -------------------------------------------------
# NOTE: opcache is compiled into the PHP 8.5 binary and always loaded —
# there is no more opcache.so to build/enable. Do not add it here.
# intl needs ICU >= 57.2 on PHP 8.5+ — check `pkg-config --modversion icu-i18n`
# if this step errors on your base image's ICU version.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        gd \
        intl \
        zip

# --- APCu ------------------------------------------------------------
# No stable PECL release for 8.5 at time of writing — pull beta channel.
RUN pecl channel-update pecl.php.net \
    && pecl install apcu-beta \
    && docker-php-ext-enable apcu

# --- Xdebug (dev only) -------------------------------------------------
# Use 3.5.x — this is the first line with PHP 8.5 support (not the older
# stable line). Pin a real published version rather than "latest".
ARG INSTALL_XDEBUG=true
RUN if [ "$INSTALL_XDEBUG" = "true" ]; then \
        pecl install xdebug \
        && docker-php-ext-enable xdebug; \
    fi

# --- Composer ----------------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --- PHP config ---------------------------------------------------------
COPY config/custom_config.ini /usr/local/etc/php/conf.d/

# Symfony-friendly opcache defaults.
# On 8.5, opcache.* settings still apply via php.ini/conf.d — you just
# don't load the extension with zend_extension= anymore.
RUN { \
        echo 'opcache.memory_consumption=256'; \
        echo 'opcache.max_accelerated_files=20000'; \
        echo 'opcache.validate_timestamps=1'; \
        echo 'realpath_cache_size=4096K'; \
        echo 'realpath_cache_ttl=600'; \
    } > /usr/local/etc/php/conf.d/symfony.ini

ENV PATH="/var/www/application/vendor/bin:$PATH"
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN useradd -ms /bin/bash ${PHP_USER}
USER ${PHP_USER}

WORKDIR /var/www/application
