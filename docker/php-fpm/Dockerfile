FROM php:7.2-fpm-alpine
WORKDIR "/app"

ADD ./xdebug.ini /usr/local/etc/php/conf.d/00_xdebug.ini
ADD ./custom.ini /usr/local/etc/php/conf.d/99_custom.ini
ADD ./php-fpm.conf /usr/local/etc/php/php-fpm.d/zz-docker.conf

# Install Xdebug:
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
