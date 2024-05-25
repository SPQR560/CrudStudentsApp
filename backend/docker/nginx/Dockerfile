FROM nginx:alpine

ADD ./default.conf /etc/nginx/conf.d/default.conf

RUN set -x ; \
    addgroup -g 82 -S www-data ; \
    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

WORKDIR /var/www/app
