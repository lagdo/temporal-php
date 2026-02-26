FROM lagdo/alpine-php-grpc-nginx-unit

ARG PHP_USER
ARG PHP_UID
ARG PHP_GID
ENV PHP_USER=${PHP_USER}
ENV PHP_UID=${PHP_UID}
ENV PHP_GID=${PHP_GID}

ENV COMMAND_DIR=/var/www
ENV RUN_INSTALL=true
ENV INSTALL_OPTIONS=install
ENV RUN_CACHE_CLEAR=true
ENV CACHE_CLEAR_COMMAND="artisan cache:clear"

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
  touch /var/run/unit.pid && \
  touch /var/log/unit.log && \
  mkdir -p /usr/local/var && \
  mkdir -p /var/www && \
  # Make sure files/folders needed by the processes are accessible
  chown -R ${PHP_USER}:${PHP_USER} /var/log/unit.log \
    /usr/local/var /var/www /var/run /run

# Configure Nginx Unit
COPY workflow-api/nginx-unit/config/www.json /docker-entrypoint.d/config.json

# Switch to use a non-root user from here on
USER ${PHP_USER}

WORKDIR /var/www
