FROM php:8.4-fpm-alpine

ARG USER_ID
ARG GROUP_ID

# Системные зависимости
RUN apk add --no-cache \
    bash git unzip icu-dev libzip-dev postgresql-dev rabbitmq-c-dev linux-headers $PHPIZE_DEPS

# PHP extensions (Symfony + Postgres)
RUN docker-php-ext-configure intl \
 && docker-php-ext-install -j$(nproc) intl opcache zip pdo_pgsql

# Redis, Xdebug, AMQP
RUN pecl install redis xdebug amqp \
 && docker-php-ext-enable redis xdebug amqp

RUN addgroup -g ${GROUP_ID} appgroup && \
    adduser -u ${USER_ID} -G appgroup -s /bin/sh -D appuser

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Конфиги
COPY docker/php/conf.d/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

WORKDIR /var/www/app

RUN chown appuser:appgroup /var/www/app

USER appuser
