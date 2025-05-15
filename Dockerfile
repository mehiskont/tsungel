FROM php:8.0.30-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    curl

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo_mysql \
    zip \
    exif \
    bcmath

# Install and configure GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# PHP configuration
COPY ./config/php.conf.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

# Expose port 9000
EXPOSE 9000