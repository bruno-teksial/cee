FROM mileschou/phalcon:7.4-fpm-alpine AS base

    RUN apk --update add --virtual build-dependencies build-base openssl-dev autoconf \
        && pecl install mongodb \
        && docker-php-ext-enable mongodb \
        && apk del build-dependencies build-base openssl-dev autoconf \
        && rm -rf /var/cache/apk/*

FROM base AS middleware
    COPY ./src /var/www/html
    WORKDIR /var/www/html

    RUN apk add git wget && \
        wget https://getcomposer.org/installer && \
        php installer --install-dir=/usr/local/bin/ --filename=composer && \
        rm installer && \
        composer install --no-dev --no-interaction --optimize-autoloader

FROM middleware AS dev
    ENV APP_ENV=dev
    RUN composer install --no-interaction --optimize-autoloader

FROM dev AS test
    ENV APP_ENV=test

FROM base AS prod
    ENV APP_ENV=prod
    COPY --from=middleware /var/www/html /var/www/html
    COPY --from=middleware /vendor /vendor