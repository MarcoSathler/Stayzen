FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libxml2-dev

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_mysql mbstring xml pcntl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy xdebug configuration
COPY docker/php/xdebug.ini "${PHP_INI_DIR}/conf.d"

WORKDIR /var/www/html

CMD ["php-fpm"]