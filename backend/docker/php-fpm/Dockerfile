FROM php:8.3-fpm-alpine

RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash
RUN apk add --update linux-headers

#xdebug (not for prod)
RUN pecl install xdebug && docker-php-ext-enable xdebug;
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#postgres
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_pgsql

# Create not a root user.
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

USER www-data

WORKDIR /var/www/app