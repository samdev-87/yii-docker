FROM php:7.4.28-fpm-buster

RUN apt-get update
RUN apt-get install -y \
            git \
            libzip-dev \
            libc-client-dev \
            libkrb5-dev \
            libpng-dev \
            libjpeg-dev \
            libwebp-dev \
            libfreetype6-dev \
            libkrb5-dev \
            libicu-dev \
            zlib1g-dev \
            zip \
            ffmpeg \
            libmemcached11 \
            libmemcachedutil2 \
            build-essential \
            libmemcached-dev \
            gnupg2 \
            libpq-dev \
            libz-dev \
            nano \
            cron

RUN docker-php-ext-configure gd \
    --with-webp=/usr/include/ \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

RUN docker-php-ext-configure imap \
    --with-kerberos \
    --with-imap-ssl
RUN docker-php-ext-install imap

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pgsql pdo_pgsql
RUN docker-php-ext-install exif
RUN docker-php-ext-install fileinfo

RUN ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN sed -i -e 's/;extension=pgsql/extension=pgsql/' /usr/local/etc/php/php.ini
RUN sed -i -e 's/;extension=pdo_pgsql/extension=pdo_pgsql/' /usr/local/etc/php/php.ini

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install memcached

RUN echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini

RUN apt-get -y autoremove \
    && apt-get -y clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/cache/*

ENV COMPOSER_ALLOW_SUPERUSER 1

# Copy existing app directory
COPY . /app
WORKDIR /app

# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

RUN chown -R www-data:www-data /var/www

EXPOSE 8000

CMD ["php-fpm"]