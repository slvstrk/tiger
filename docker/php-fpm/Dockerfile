FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    nano \
    libzip-dev \
    zip \
    libicu-dev \
    curl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html
USER www-data

CMD ["php-fpm"]
