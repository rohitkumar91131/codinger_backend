# Use official PHP with Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql zip mbstring intl \
    && a2enmod rewrite

# Set Apache document root to CodeIgniter's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy app files
COPY . /var/www/html

# Set permissions for writable folders
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port (Render expects process to bind $PORT)
EXPOSE 8080

ENV CI_ENVIRONMENT=production

CMD ["apache2-foreground"]
