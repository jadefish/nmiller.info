FROM php:7.2-fpm-alpine
WORKDIR "/app"

ADD ./custom.ini /usr/local/etc/php/conf.d/
ADD ./xdebug.ini /usr/local/etc/php/conf.d/00_xdebug.ini

# Install Xdebug:
RUN apk update && \
    apk add php7-xdebug
