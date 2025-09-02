# Official PHP image with Apache
FROM php:8.1-apache

# Enable mod_rewrite for CodeIgniter's .htaccess
RUN a2enmod rewrite

# Copy and overwrite the default Apache virtual host configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Re-enable the configuration (though it's already there) to ensure it's active
RUN a2ensite 000-default.conf

# Copy project files into the Apache web root
COPY . /var/www/html/

# Set permissions for the writable directory
RUN chown -R www-data:www-data /var/www/html/writable
RUN chmod -R 755 /var/www/html/writable

# Expose port 80
EXPOSE 80

