FROM php:7.4-apache

#put stuff into the apache debian server
COPY src/ /var/www/html/
COPY .htaccess /var/www/html/
RUN a2enmod rewrite headers
#http port
EXPOSE 80 

#this makes no sense idk why but installing sql on the debian server works but not doing this doesnt idk
RUN apt-get update && apt-get install -y \
    mariadb-client \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite
