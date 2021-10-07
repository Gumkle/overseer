FROM php:8.0-fpm
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /bin/composer
RUN apt update -y && apt install -y git libzip-dev
RUN docker-php-ext-install sockets zip

ADD entrypoint.sh /var/www/html/entrypoint.sh

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
