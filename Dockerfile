FROM php:8.2-apache

# Cài extension cần cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable apache rewrite
RUN a2enmod rewrite

# Set thư mục làm việc
WORKDIR /var/www/html

# Copy source code
COPY . .

# Cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài package PHP
RUN composer install --no-dev --optimize-autoloader

# Set quyền
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Apache config
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

EXPOSE 80
