FROM php:7.3-fpm
#This is Debian 11 os

# 主要是session file系統預設是 /var/lib/php，但container沒有這個folder，先暫存/var/lib
ENV PHP_INI_DIR=/usr/local/etc/php \
    PHP_DATA_DIR=/var/lib \
    ENV_CONFIG_DIR=/var/www/html \
    PHP_CONF_DIR=/usr/local/etc/php-fpm.d

# ENV PHP_CONF_DIR=etc/php/7.3 \
#     PHP_DATA_DIR=/var/lib/php

RUN chown www-data:www-data ${PHP_INI_DIR} -Rf \
    && chown www-data:www-data ${PHP_DATA_DIR} -Rf \
    && chown www-data:www-data ${ENV_CONFIG_DIR} -Rf \
    && chown www-data:www-data ${PHP_CONF_DIR} -Rf

RUN apt-get update
RUN apt-get install -y \
    software-properties-common\
    vim \
    zip \
    unzip \
    git \
    curl \
    sudo \
    procps \
    gcc \
    make \
    autoconf \
    libc-dev \
    pkg-config \
    #libmysqlclient-dev \
    default-mysql-client\
    cmake \ 
    wget \
    gnupg \
    mosquitto-clients


RUN apt-get install -y ssl-cert


RUN sudo apt-get -y install lsb-release apt-transport-https ca-certificates
RUN sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php7.3.list
RUN apt-get update

RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install -f xdebug-3.1.5
RUN docker-php-ext-enable xdebug


RUN apt-get purge -y --auto-remove $BUILD_DEPS \
	&& apt-get autoremove -y \
	&& rm -rf /var/lib/apt/lists/*

COPY --chown=www-data:www-data ../data/ ${ENV_CONFIG_DIR}/

COPY --chown=www-data:www-data /php/www.conf ${PHP_CONF_DIR}/


# cookies 資料夾
RUN cd ${ENV_CONFIG_DIR}\
    && mkdir cookies \
    && chown www-data:www-data cookies


# 直接把 image內的路徑copy到自己容器中
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN export ENV_CONFIG_DIR=/var/www/html



# 成功帶入 參數 php.ini
# 明天繼續 安裝 composer
