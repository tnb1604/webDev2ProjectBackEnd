FROM php:8.2-cli-alpine

WORKDIR /app

# Install dependencies
RUN apk update && apk add --no-cache \
    pdo \
    pdo_mysql \
    mysql-client \
    && docker-php-ext-install pdo pdo_mysql

# Copy app files
COPY . .

# Expose port 8000 (since we're using PHP's built-in server)
EXPOSE 8000

# Serve app/public as the web root
CMD ["php", "-S", "0.0.0.0:8000", "-t", "app/public"]
