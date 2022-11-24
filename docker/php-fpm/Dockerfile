FROM php:8.1.0-fpm-alpine

# Install packages
RUN apk add --no-cache icu-dev curl git build-base zlib-dev oniguruma-dev autoconf bash nodejs npm 


# Xdebug
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; \
    then \
      pecl install xdebug && docker-php-ext-enable xdebug; \
    fi;

COPY ./docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY ./docker/php-fpm/php.ini /usr/local/etc/php/conf.d/php.ini 
#setup ext
RUN apk add --no-cache libpq-dev && docker-php-ext-install \
mysqli pdo_pgsql pdo_mysql pdo intl opcache \
&& docker-php-ext-enable  \
opcache intl

#intl opcache gd mbstring mcrypt soap zip
COPY ./docker/php-fpm/php.ini /usr/local/etc/php/conf.d/php.ini

# Configure non-root user.
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Source code
RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www
WORKDIR /var/www

USER www-data

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction

#NPM
RUN npm install --no-interaction


# Symfony CLI
CMD ['/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"']
CMD ['brew install symfony-cli/tap/symfony-cli']
#RUN curl -sS https://get.symfony.com/cli/installer | bash 
##&& mv ~/.symfony/bin/symfony /usr/local/bin/symfony

#UN curl -sS https://get.symfony.com/cli/installer | bash
#RUN wget https://get.symfony.com/cli/installer -O - | bash
#RUN echo 'export PATH="$HOME/.symfony/bin:$PATH"' >> ~/.bashrc
#RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

#sudo apk add --no-cache bash
#RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
#3RUN apk add symfony-cli

CMD php-fpm

EXPOSE 9000