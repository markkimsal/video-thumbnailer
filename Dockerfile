FROM markkimsal/php-platform:8.0-nginx-fpm

RUN set -ex \
    && { \
            apt-get update ; \
            apt-get install -y --no-install-recommends ffmpeg; \
            rm -rf /var/lib/apt/lists/*; \
       }

COPY --chown=www-data app /app/
COPY nginx-vhost.conf /etc/nginx/sites-available/default
