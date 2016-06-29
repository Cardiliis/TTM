FROM php:7.0.7-apache
COPY src/ /var/www/html/

COPY ./src/assets /var/www/TTM/assets
COPY ./src/config /var/www/TTM/config
COPY ./src/src /var/www/TTM/src
COPY ./src/vendor /var/www/TTM/vendor
COPY ./src/views /var/www/TTM/views
COPY ./src/www /var/www/TTM/www

RUN mkdir /var/www/TTM/var

VOLUME /var/www/TTM
