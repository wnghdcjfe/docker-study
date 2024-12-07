FROM php:8.2-fpm


# 패키지 업데이트 및 유틸리티 설치
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zip \
    unzip \
    git && \
    docker-php-ext-install pdo_mysql

# Laravel 전용 그룹 및 사용자 생성
RUN groupadd -g 1000 laravel && \
    useradd -m -g laravel -s /bin/bash -u 1000 laravel

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 작업 디렉토리 설정
WORKDIR /var/www/html

# 권한 설정
COPY . /var/www/html
RUN chown -R laravel:laravel /var/www/html

# 기본 사용자 변경
USER laravel
