FROM php:8.2-cli

# Install system dependencies + MySQL & PostgreSQL PDO drivers
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpq-dev \
    gnupg \
 && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql

# Install Node.js (for Vite assets)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy dependency files first for better caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-scripts \
    --ignore-platform-reqs

# Copy the rest of the application
COPY . .

# Build assets
RUN npm install && export APP_ENV=production && npm run build

# Set up storage and database permissions
RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs database \
    && touch database/database.sqlite \
    && chmod -R 777 storage bootstrap/cache database \
    && chmod +x start.sh

EXPOSE 10000

# Use the startup script
CMD ["./start.sh"]