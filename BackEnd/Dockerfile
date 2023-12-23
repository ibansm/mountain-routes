FROM php:8.2-apache as php

# Enable mod_rewrite
RUN a2enmod rewrite

RUN apt-get update -y
RUN apt-get install -y git unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Clone the application code
RUN \
    mkdir /proyecto \  
    && git clone https://github.com/ibansm/mountain-routes.git /proyecto \
    && cd /proyecto/BackEnd \
    && cp -r . /var/www/html \
    && chmod 777 /var/www/html/Docker/entrypoint.sh
# COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permissions
#RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache