FROM alpine:3.6

RUN apk add --update \
    php7-fpm \
    php7-apcu \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-gd \
    php7-iconv \
    php7-imagick \
    php7-json \
    php7-intl \
    php7-mcrypt \
    php7-mbstring \
    php7-opcache \
    php7-openssl \
    php7-pdo \
    php7-pdo_mysql \
    php7-mysqli \
    php7-xml \
    php7-zlib \
    php7-phar \
    php7-tokenizer \
    php7-session \
    php7-simplexml \
    php7-sqlite3 \
    php7-pdo_sqlite \
    make \
    --no-cache tzdata \
    curl

RUN apk update && apk add ca-certificates && update-ca-certificates && apk add openssl
RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer self-update && composer --version && composer config --global repo.packagist composer https://packagist.org
RUN export TZ='America/Argentina/Buenos_Aires'

ADD php.ini /etc/php7/php-fpm.d/
ADD php.ini /etc/php7/cli/conf.d/

ADD php.pool.conf /etc/php7/php-fpm.d/

CMD ["php-fpm7", "-F"]

WORKDIR /var/www
EXPOSE 9000
