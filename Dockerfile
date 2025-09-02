FROM php:8.1-apache

RUN a2enmod rewrite

# Copy the custom Apache configuration file into the container
COPY 000-default.conf /etc/apache2/sites-available/

# Enable the new configuration and disable the old one
RUN a2ensite 000-default.conf
RUN a2dissite 000-default.conf

# Copy project files and set permissions
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/writable
RUN chmod -R 755 /var/www/html/writable

EXPOSE 80

