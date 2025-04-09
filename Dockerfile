FROM php:8.2-cli-alpine

WORKDIR /app

# Install PHP extensions
RUN apk update && apk add --no-cache \
    pdo_mysql \
    && docker-php-ext-install pdo pdo_mysql

# Copy app files
COPY . .

# Expose the correct port
EXPOSE 8000

# Serve app/public as the web root
CMD ["php", "-S", "0.0.0.0:8000", "-t", "app/public"]
