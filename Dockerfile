# Use PHP 7.4 FPM image
FROM php:7.4-fpm

# Install dependencies for PHP, Node.js, and Composer
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    libzip-dev \
    curl \
    bash \
    libpq-dev \
    libonig-dev \
    nodejs \
    npm \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Clear apt-get cache to reduce image size
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy custom PHP config (if needed)
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install required PHP extensions for Laravel
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install GD (for image manipulation)
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Install opcache (for caching)
RUN docker-php-ext-install opcache

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js dependencies and Laravel Mix (for Metronic)
RUN npm install -g npm@latest

# Add user for laravel application
RUN groupadd -g 1005 www && \
    useradd -u 1005 -ms /bin/bash -g www www

# Set working directory to the Laravel app folder
WORKDIR /var/www

# Copy application files to the container
COPY . /var/www

# Set file permissions (important for Laravel)
RUN chown -R www:www /var/www

# Switch to the 'www' user (non-root for security)
USER www

# Install Composer dependencies (Laravel)
RUN composer install --no-dev --optimize-autoloader

# Install NPM dependencies (Metronic)
RUN npm install

# Build Metronic assets (Laravel Mix)
RUN npm run prod

# Cache Laravel config, routes, and views for production
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Expose port 9000 for PHP-FPM (or 8000 for artisan serve)
EXPOSE 9000

# Set the command to start PHP-FPM (use Artisan for Laravel)
CMD ["php-fpm"]
