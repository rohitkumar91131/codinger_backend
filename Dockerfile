# Official PHP image with Apache
FROM php:8.1-apache

# Enable mod_rewrite for CodeIgniter's .htaccess
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Copy and enable the custom Apache configuration
COPY 000-default.conf /etc/apache2/sites-available/
RUN a2ensite 000-default.conf
RUN a2dissite 000-default.conf

# Set permissions for the writable directory
RUN chown -R www-data:www-data /var/www/html/writable
RUN chmod -R 755 /var/www/html/writable

# Expose port 80
EXPOSE 80

