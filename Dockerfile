FROM php:8.2-cli

# Install packages + MySQL PDO driver
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
 && docker-php-ext-install zip pdo pdo_mysql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install \
 --no-dev \
 --optimize-autoloader \
 --no-scripts \
 --ignore-platform-reqs

# Copy project files
COPY . .

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=$PORT