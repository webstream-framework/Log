FROM php:7.4-cli
LABEL maintainer Ryuichi Tanaka <mapserver2007@gmail.com>

RUN apt-get update && apt-get install -y \
  git

RUN pecl install xdebug-2.9.8 && \
  pecl install apcu && \
  echo "opcache.enable_cli=1" > /usr/local/etc/php/conf.d/opcache-recommended.ini && \
  echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini && \
  docker-php-ext-enable apcu xdebug

RUN rm -rf /var/lib/apt/lists/* && rm -rf /tmp/pear && rm -rf /tmp/* && \
  apt-get clean -y && apt-get autoclean -y

WORKDIR /workspace
