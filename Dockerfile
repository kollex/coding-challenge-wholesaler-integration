FROM php:8.1-fpm-alpine

ENV GLOBAL_COMPOSER_HOME /root/.composer
ENV PATH $PATH:/root/.composer/vendor/bin
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk --update add \
        nginx \
        python3 \
        py-pip \
        libzip-dev \
        unzip && \
    docker-php-ext-install zip && \
    pip install --upgrade supervisor && \
    rm /var/cache/apk/*

RUN \
    rm -rf /var/www && \
    mkdir -p /var/www/public && \
    chown -R www-data:www-data /var/www/ && \
    cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
    wget https://getcomposer.org/composer-2.phar -O /usr/bin/composer && chmod +x /usr/bin/composer

ADD ./docker-files/etc /etc
ADD ./ /var/www

WORKDIR /var/www

RUN cd /var/www && \
    composer -n --no-ansi install

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]