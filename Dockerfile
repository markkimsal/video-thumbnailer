FROM markkimsal/php-nginx-phusion:7.3-fpm-db

RUN set -ex \
    && { \
            apt-get update ; \
            apt-get install -y ffmpeg; \
            rm -rf /var/lib/apt/lists/*; \
       }

COPY --chown=www-data app /app/
COPY nginx-vhost.conf /etc/nginx/sites-available/default
