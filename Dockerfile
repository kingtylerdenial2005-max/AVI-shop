FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# App folder
WORKDIR /app

# Copy project files
COPY . .

# Install Laravel dependencies (skip artisan scripts during build)
RUN composer install --no-dev --optimize-autoloader --no-scripts

EXPOSE 10000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT