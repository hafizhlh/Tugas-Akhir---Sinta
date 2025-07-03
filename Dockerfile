# Gunakan PHP 8.2 FPM image
FROM php:8.2-fpm

# Install dependencies untuk PHP, Node.js, dan Composer
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
    libsqlite3-dev \
    ca-certificates \
    lsb-release \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-install gd zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql pdo_sqlite

# Clear apt-get cache untuk mengurangi ukuran image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js dan npm (untuk kompatibilitas dengan Metronic dan Laravel Mix)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Set environment variable untuk menghindari masalah OpenSSL 3.0 di Node.js
ENV NODE_OPTIONS=--openssl-legacy-provider

# Cek versi Node.js dan npm
RUN node -v && npm -v

# Tambahkan user untuk aplikasi Laravel
RUN groupadd -g 1005 www && \
    useradd -u 1005 -ms /bin/bash -g www www

# Set working directory ke folder aplikasi Laravel
WORKDIR /var/www

# Copy file aplikasi ke dalam container
COPY . /var/www

# Set file permissions (penting untuk Laravel)
RUN chown -R www:www /var/www

# Switch ke user 'www' (non-root untuk keamanan)
USER www

# Install dependencies Composer (Laravel)
RUN composer install --no-dev --optimize-autoloader

# Install dependencies NPM (Metronic)
RUN npm install

# Build Metronic assets (Laravel Mix)
RUN npm run prod

# Cache Laravel config, routes, dan views untuk produksi
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Expose port 8080 untuk Laravel
EXPOSE 8080

# Set perintah untuk menjalankan aplikasi Laravel menggunakan php artisan serve pada port 8080
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
