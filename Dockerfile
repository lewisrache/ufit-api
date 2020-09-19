FROM trafex/alpine-nginx-php7:latest

COPY ./src /var/www/html
COPY ./log.conf /usr/local/etc/php-fpm.d/zz-log.conf
