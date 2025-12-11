FROM lagdo/alpine-php-grpc-frankenphp

ARG PHP_USER
ARG PHP_UID
ARG PHP_GID
ENV PHP_USER=${PHP_USER}
ENV PHP_UID=${PHP_UID}
ENV PHP_GID=${PHP_GID}

ENV COMMAND_DIR=/var/www
ENV COMMAND_USER=

ENV RUN_INSTALL=true

ENV RUN_CACHE_CLEAR=true
ENV CACHE_CLEAR_COMMAND="artisan cache:clear"

# Be sure to replace "your-domain-name.example.com" by your domain name
# ENV SERVER_NAME=your-domain-name.example.com
# If you want to disable HTTPS, use this value instead:
ENV SERVER_NAME=:80

# Enable PHP production settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN set -xe && \
  apk add --no-cache --virtual .build-deps bash git wget vim && \
  # Install PHP database extensions
  install-php-extensions pdo pdo_sqlite sqlite3 pdo_mysql mysqlnd mysqli pdo_pgsql pgsql && \
  # Install PHP debug extensions
  install-php-extensions xdebug && \
  # Create user group and account
  addgroup -g ${PHP_GID} --system ${PHP_USER} && \
  adduser -G ${PHP_USER} --system -D -s /bin/sh -u ${PHP_UID} ${PHP_USER} && \
  # Create project root
  mkdir -p /var/www && \
  # Make sure files/folders needed by the processes are accessible
  chown -R ${PHP_USER}:${PHP_USER} /var/www /data/caddy /config/caddy

# Switch to use a non-root user from here on
USER ${PHP_USER}

WORKDIR /var/www
