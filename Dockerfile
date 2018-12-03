#FROM php:7.2-apache
#MAINTAINER andersonalansauberlich@gmail.com
#
#RUN apt-get update \
# && apt-get install -y apache2 \
# && apt-get install -y libapache2-mod-php7.2 \
# && apt-get install -y php7.2-mysql \
# && apt-get --purge autoremove -y \
# && docker-php-ext-install zip \
# && a2enmod rewrite \
# && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
# && mv /var/www/html /var/www/html/public \
# && curl -sS https://getcomposer.org/installer \
#  | php -- --install-dir=/usr/local/bin --filename=composer
#
#WORKDIR /var/www
