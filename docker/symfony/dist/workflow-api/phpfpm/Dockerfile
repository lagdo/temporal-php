FROM lagdo/alpine-phpfpm-grpc

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
ENV CACHE_CLEAR_COMMAND="bin/console cache:clear"

RUN set -xe && \
  apk add --no-cache --virtual .build-deps bash git wget vim supervisor nginx && \
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
  chown -R ${PHP_USER}:${PHP_USER} /var/www /run /var/lib/nginx /var/log/nginx

# Configure Supervisord
COPY workflow-api/phpfpm/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# Configure PHP-FPM
COPY workflow-api/phpfpm/config/phpfpm.conf /usr/local/etc/php-fpm.d/www.conf
# Configure Nginx
COPY workflow-api/phpfpm/config/nginx.conf /etc/nginx/http.d/default.conf

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

USER ${PHP_USER}

WORKDIR /var/www
