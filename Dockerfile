FROM php:7.1.33-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install dependencies
# RUN apt-get update && \
 #   apt-get install -y build-essential locales git unzip zip curl 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
# RUN docker-php-ext-install pdo_mysql mbstring  exif pcntl
RUN apt-get update && apt-get install -y libonig-dev

# Set environment variables
ENV PKG_CONFIG_PATH=/usr/local/lib/pkgconfig
ENV ONIG_CFLAGS=-I/usr/local/include
ENV ONIG_LIBS=-L/usr/local/lib

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]



