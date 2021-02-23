FROM php:8.0-fpm

RUN apt-get update && apt-get install -y libzip-dev libicu-dev && docker-php-ext-install pdo_mysql zip intl

# Install nodejs & yarn
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && DEBIAN_FRONTEND=noninteractive apt-get install nodejs -yqq \
    && npm i -g npm \
    && curl -o- -L https://yarnpkg.com/install.sh | bash \
    && npm cache clean --force

ENV COMPOSER_HOME=/composer
ENV PATH=./vendor/bin:/composer/vendor/bin:/root/.yarn/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

EXPOSE 9000