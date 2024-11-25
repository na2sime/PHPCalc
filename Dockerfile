FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer PHPStan
RUN composer global require phpstan/phpstan

# Installer PHPCS
RUN composer global require squizlabs/php_codesniffer

# Ajouter les commandes globales Composer au PATH
ENV PATH="/root/.composer/vendor/bin:${PATH}"