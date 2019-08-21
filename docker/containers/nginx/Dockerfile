FROM nginx:latest

COPY . /var/www/
COPY docker/containers/nginx/vhost.conf /etc/nginx/conf.d/default.conf
COPY docker/containers/nginx/gzip.conf /etc/nginx/conf.d/gzip.conf
COPY docker/containers/nginx/nginx-startup.sh /startup.sh
RUN chmod -R 777 startup.sh;
COPY docker/containers/nginx/ssl/ssl-cert.crt /etc/ssl/certs/ssl-cert.crt
COPY docker/containers/nginx/ssl/ssl-cert.key /etc/ssl/private/ssl-cert.key
CMD ["sh", "-c", "/startup.sh"]
