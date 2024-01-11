# Используйте официальный образ PHP с Apache
FROM php:8.2-fpm

# Установите расширения PHP, необходимые для Symfony
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libpq-dev \
        libicu-dev \
        git \
        unzip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql intl


RUN docker-php-ext-install bcmath

# Копируйте исходный код Symfony в контейнер
COPY . /var/www/html

# Установите Composer для управления зависимостями PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установите зависимости Composer
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --optimize-autoloader

# Настройте Apache

# Дайте права на запись в папки var и vendor
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor

# Выставьте правильные разрешения
RUN chmod -R 755 /var/www/html/var