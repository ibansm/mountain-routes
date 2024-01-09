FROM php:8.2-apache as php

# Enable mod_rewrite
RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    nano \
    git \
    unzip \
    libpq-dev \
    libcurl4-gnutls-dev

RUN docker-php-ext-install pdo pdo_mysql bcmath

# Set the working directory
WORKDIR /var/www/html

# Clone the application code
RUN \
    mkdir /home/proyecto \  
    && git clone https://github.com/ibansm/mountain-routes.git /home/proyecto \
    && chmod 777 /home/proyecto/BackEnd/Docker/entrypoint.sh \
    && chmod 777 -R /home/proyecto/BackEnd/storage \
    && ln -s /home/proyecto/BackEnd/public /var/www/html/ \
    && chmod 755 /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["/usr/bin/apache2ctl", "-D", "FOREGROUND"]

EXPOSE 80

# For local proyect
# COPY . /var/www/html

