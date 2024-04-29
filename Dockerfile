# Use the official PHP image with Apache
FROM php:7.4-apache

# Enable mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Install mysqli extension for PHP
RUN docker-php-ext-install pdo_mysql

# Copy Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy project files into the container
COPY . .

# Set permissions for the directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]