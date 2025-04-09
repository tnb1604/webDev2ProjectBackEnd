FROM php:8.2-cli-alpine

WORKDIR /app

# Install dependencies
RUN apk update && apk add --no-cache \
    mysql-client \
    && docker-php-ext-install pdo_mysql

# Copy app files
COPY . .

# Expose port 8000 (since we're using PHP's built-in server)
EXPOSE 9000

# Serve app/public as the web root
CMD ["php", "-S", "0.0.0.0:9000", "-t", "app/public"]
