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
    && docker-php-ext-install \
        bz2 \
        curl \
        exif \
        fileinfo \
        gettext \
        gd \
        mbstring \
        mysqli \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        pgsql \
        zip \
    && docker-php-ext-enable \
        bz2 \
        curl \
        exif \
        fileinfo \
        gettext \
        gd \
        mbstring \
        mysqli \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        pgsql \
        zip

# Clear apt-get cache untuk mengurangi ukuran image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js dan npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Set environment variable untuk menghindari masalah OpenSSL 3.0 di Node.js
ENV NODE_OPTIONS=--openssl-legacy-provider

# Cek versi
RUN node -v && npm -v

# Tambahkan user non-root
RUN groupadd -g 1005 www && \
    useradd -u 1005 -ms /bin/bash -g www www

WORKDIR /var/www

# Copy source code aplikasi ke container
COPY . /var/www

# Set permission
RUN chown -R www:www /var/www

USER www

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run prod

# Cache konfigurasi Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan route:clear && \
    php artisan config:clear && \
    php artisan cache:clear

# Expose port
EXPOSE 8080

# Start Laravel pakai php artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]