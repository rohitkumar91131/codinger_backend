# Use official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application code
COPY . /var/www/html

# Set permissions for CodeIgniter writable folders
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies via Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port 8080 (Render default)
EXPOSE 8080

# Set environment variable for CodeIgniter
ENV CI_ENVIRONMENT=production

# Start Apache in foreground
CMD ["apache2-foreground"]

