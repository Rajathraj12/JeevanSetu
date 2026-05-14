# Stage 1: Build Front-End Assets
FROM node:20-slim AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Production PHP App
FROM php:8.3-apache

# Set Composer environment variables to avoid permission/memory issues
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (layer caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (ignore platform reqs to avoid version conflicts)
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs \
    --no-interaction \
    --prefer-dist

# Copy all project files
COPY . .

# Copy built front-end assets from Stage 1
COPY --from=assets-builder /app/public/build ./public/build

# Run autoloader dump after full copy
RUN composer dump-autoload --optimize --no-interaction --ignore-platform-reqs

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache mod_rewrite and point to public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite

# Create deployment entrypoint script
RUN printf '#!/bin/bash\nset -e\nphp artisan migrate --force\nphp artisan db:seed --force\nphp artisan config:cache\nphp artisan route:cache\nphp artisan view:cache\napache2-foreground\n' > /usr/local/bin/deploy.sh \
    && chmod +x /usr/local/bin/deploy.sh

EXPOSE 80

CMD ["/usr/local/bin/deploy.sh"]
