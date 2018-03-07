FROM php:7.1-apache

RUN a2enmod rewrite && a2enmod headers

# install the PHP extensions we need
RUN apt-get update \
        && apt-get install -y  \
        locales \
        git-core \
        libsqlite3-dev \
        libicu-dev \
        libfreetype6-dev \
        libmcrypt-dev \
        libpq-dev \
        libexif-dev \
        libmcrypt-dev \
        git-all \
        && rm -rf /var/lib/apt/lists/* \
        && docker-php-ext-install calendar mcrypt gettext intl exif zip mbstring json bcmath

RUN apt-get update && apt-get dist-upgrade -y && \
    apt-get install -y wget curl apt-transport-https ca-certificates  && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install; exit 0
RUN chown -R www-data /var/www

VOLUME /var/www
RUN service apache2 restart