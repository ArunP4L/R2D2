FROM ubuntu:latest
MAINTAINER Arun Gimblett <gimblett44@gmail.com>

# Install apache, PHP, and supplimentary programs. openssh-server, curl
RUN apt-get update && apt-get -y upgrade && DEBIAN_FRONTEND=noninteractive apt-get -y install \
    apache2 \
    php7.2 \
    php7.2-mysql \
    php7.2-xml \
    php7.2-zip \
    php7.2-mbstring \
    libapache2-mod-php7.2 \
    php7.2-xdebug \
    git \
    zip \
    curl

# Enable apache mods.
RUN a2enmod php7.2
RUN a2enmod rewrite

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Expose apache.
EXPOSE 80

ADD . /var/www/html/
COPY /Docker/Apache/http.conf /etc/apache2/sites-available/000-default.conf

# forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

COPY /Docker/php/php.ini /etc/php/7.2/apache2/php.ini

CMD /usr/sbin/apache2ctl -D FOREGROUND
