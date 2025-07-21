FROM php:8.4-fpm

WORKDIR /var/www/html

RUN apt-get update \
 && apt-get install -y \
      libpq-dev libicu-dev libzip-dev \
      zip unzip git curl \
      build-essential libmemcached-dev \
 && docker-php-ext-configure zip \
 && docker-php-ext-install \
      pdo_pgsql \
      zip \
      intl \
      sockets \
 && pecl install memcached \
 && docker-php-ext-enable memcached \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

COPY composer.json composer.lock artisan bootstrap/ package.json package-lock.json vite.config.ts ./

RUN composer install --no-dev --no-autoloader
RUN npm ci

COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000 5173
CMD ["php-fpm"]
