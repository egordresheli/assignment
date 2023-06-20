FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get clean && apt-get update && apt-get upgrade -y


RUN apt-get install -y \
    git \
    libcurl4-openssl-dev \
    libonig-dev \
    libpng-dev \
    libssl-dev \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    wget \
    zip \
    tzdata

RUN apt-get update && apt-get install -my wget gnupg

ARG INSTALL_PHPREDIS=false

RUN pecl install redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

RUN docker-php-ext-configure intl

RUN docker-php-ext-install \
    bcmath \
    ctype \
    exif \
    gd \
    mbstring \
    mysqli \
    opcache \
    pdo_mysql \
    pcntl \
#    tokenizer \
    xml \
    intl \
    zip

RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd


ENV COMPOSER_HOME=/root/.composer/

WORKDIR /apps

EXPOSE 9000
CMD ["php-fpm"]
