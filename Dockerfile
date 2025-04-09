# Use an official PHP image as the base
FROM php:8.2-fpm-alpine

# Update package manager and install security updates
RUN apk update && apk upgrade --no-cache

WORKDIR /app

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy application files
COPY . .

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
