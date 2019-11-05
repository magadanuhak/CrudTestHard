FROM php:7.0-fpm

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev libpng-dev libxml2-dev && \
        pecl install xdebug-2.6.0 && \
        docker-php-ext-enable xdebug
RUN apt-get update && \
  apt-get install -y ssmtp && \
  apt-get clean && \
  echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf && \
  echo 'sendmail_path = "/usr/sbin/ssmtp -t"' > /usr/local/etc/php/conf.d/mail.ini


RUN docker-php-ext-install -j$(nproc) mysqli mbstring zip gd soap calendar

RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

ENV TZ Europe/Chisinau
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
