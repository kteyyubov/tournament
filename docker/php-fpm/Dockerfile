FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        libicu-dev \
        bash \
        vim \
        unzip \
        zip

RUN docker-php-ext-install \
        intl \
        pdo_mysql \
        mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clean up
RUN apt-get -y autoremove && \
    apt-get -y clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/cache/*
