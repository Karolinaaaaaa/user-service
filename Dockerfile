
# Use the official PHP image
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y     git     unzip     libpq-dev     libzip-dev     && docker-php-ext-install pdo pdo_pgsql pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install dependencies
RUN composer install

# Expose port
EXPOSE 8000

# Run the Symfony server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
