FROM php:8.2-apache

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache document root to /var/www/app/public
ENV APACHE_DOCUMENT_ROOT=/var/www/app/public
RUN sed -i 's!/var/www/html!/var/www/app/public!g' /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/app

# Install Composer
RUN apt-get update && apt-get install -y unzip git curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . .

# Install PHP dependencies and autoload
RUN composer install --no-interaction --no-progress && composer dump-autoload --optimize

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Expose port
EXPOSE 80
