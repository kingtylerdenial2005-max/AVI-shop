FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
 && docker-php-ext-install zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first
COPY composer.json composer.lock ./

# Install packages without running artisan scripts
RUN composer install \
 --no-dev \
 --optimize-autoloader \
 --no-scripts \
 --ignore-platform-reqs

# Copy rest of project
COPY . .

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=$PORT