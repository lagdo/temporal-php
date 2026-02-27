FROM lagdo/alpine-php-grpc-roadrunner

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

ARG RR_CONFIG_FILE
ENV RR_CONFIG_FILE=/usr/local/etc/rr.yaml

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
  mkdir -p /usr/local/etc && \
  # Make sure files/folders needed by the processes are accessible
  chown -R ${PHP_USER}:${PHP_USER} /var/www /usr/local/etc

# Switch to use a non-root user from here on
USER ${PHP_USER}

WORKDIR /var/www
