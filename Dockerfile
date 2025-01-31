# Use an official PHP image with Apache
FROM php:8.2-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files to the web root
COPY . /var/www/html

# Set permissions for the web root
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
