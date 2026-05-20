FROM php:8.1-apache

# Install PHP extensions required by the app
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the document root to /var/www/html
ENV APACHE_DOCUMENT_ROOT=/var/www/html

# Copy all project files into the container
COPY . /var/www/html/

# Set proper permissions for uploads directory
RUN mkdir -p /var/www/html/dist/uploads && \
    chown -R www-data:www-data /var/www/html/dist/uploads && \
    chmod -R 755 /var/www/html/dist/uploads

# Set working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

CMD ["apache2-foreground"]
