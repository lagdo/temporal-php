FROM lagdo/alpine-php-grpc-roadrunner

ARG PHP_USER
ARG PHP_UID
ARG PHP_GID
ENV PHP_USER=${PHP_USER}
ENV PHP_UID=${PHP_UID}
ENV PHP_GID=${PHP_GID}

ENV COMPOSER_RUN=true
ENV COMPOSER_RUN_DIR=/var/www
ENV COMPOSER_RUN_USER=${PHP_USER}

RUN set -xe && \
  apk add --no-cache --virtual .build-deps bash git wget vim && \
  # Install PHP debug extensions
  install-php-extensions xdebug && \
  # Create user group and account
  addgroup -g ${PHP_GID} --system ${PHP_USER} && \
  adduser -G ${PHP_USER} --system -D -s /bin/sh -u ${PHP_UID} ${PHP_USER} && \
  # Create project root
  mkdir -p /var/www && \
  # Make sure files/folders needed by the processes are accessible
  chown -R ${PHP_USER}:${PHP_USER} /var/www

WORKDIR /var/www
