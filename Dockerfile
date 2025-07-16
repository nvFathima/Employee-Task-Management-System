# Use official PHP-Apache base image
FROM php:7.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Copy all your PHP files to the container's web root
COPY . /var/www/html/

# Give write permission (optional if needed)
RUN chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80