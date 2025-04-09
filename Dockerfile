FROM php:8.2-cli-alpine

WORKDIR /app

# Install dependencies
RUN apk update && apk add --no-cache \
    mysql-client \
    && docker-php-ext-install pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 8000 (since we're using PHP's built-in server)
EXPOSE 8000

# Serve app/public as the web root
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
