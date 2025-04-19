FROM php:8.2-fpm

# Install packetes linux
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    curl
#     git \
#   vim \
#    jpegoptim optipng pngquant gifsicle \


# Install extensions php
RUN docker-php-ext-install zip exif pcntl  && \
    apt-get update && \
    apt-get install -y libicu-dev  && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) opcache intl pdo_pgsql pgsql && \
    pecl install apcu  && \
    docker-php-ext-enable apcu pdo_pgsql sodium && \
    docker-php-ext-install gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer self-update --2

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Set working directory
WORKDIR /var/www/app

USER www

EXPOSE 9000
CMD ["php-fpm"]