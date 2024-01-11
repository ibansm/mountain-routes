
# Image
FROM php:8.2-apache as php

# Enable mod_rewrite
RUN a2enmod rewrite

# Install 
RUN apt-get update && apt-get install -y \
    nano \
    npm \
    git \
    unzip \
    libpq-dev \
    libcurl4-gnutls-dev 

RUN docker-php-ext-install pdo pdo_mysql bcmath

# Run
RUN mkdir /home/proyecto 

# Working directory
WORKDIR /var/www/html

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN \
    git clone https://github.com/ibansm/mountain-routes.git /home/proyecto \
    && chmod 777 /home/proyecto/BackEnd/Docker/entrypoint.sh \
    && chmod 777 -R /home/proyecto/BackEnd/storage \
    && ln -s /home/proyecto/BackEnd/public /var/www/html/ \
    && chmod 755 /var/www/html \
    && cd /home/proyecto/FrontEnd && npm install @angular/cli -g && npm i \
    && ng build --configuration production \
    && cd /var/www/html && cp -r /home/proyecto/FrontEnd/dist/front-end/* .


# Port
EXPOSE 80
