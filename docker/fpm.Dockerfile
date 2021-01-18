FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
        build-essential \
        libpng-dev \
        libjpeg62-turbo-dev \
        libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
        libfreetype6 \
        libfreetype6-dev \
        locales \
        zip \
        vim \
        jpegoptim optipng pngquant gifsicle \
        git \
        curl \
        libzip-dev zip unzip && \
        docker-php-ext-configure zip && \
        docker-php-ext-install zip && \
        docker-php-ext-install gd && \
        php -m | grep -q 'zip' \
    && docker-php-ext-install pdo pdo_mysql

RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Change current user to www
USER root

# Workdir
WORKDIR /var/www/

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
