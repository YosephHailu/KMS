#!/bin/bash

cp .env.example .env

git submodule update --force --recursive --init --remote

cd laradock

cp .env.example .env

COMPOSE_PROJECT_NAME=Store
sed -i "s/^COMPOSE_PROJECT_NAME.*/COMPOSE_PROJECT_NAME=${COMPOSE_PROJECT_NAME}/" .env

PHP_VERSION=7.2
sed -i "s/^PHP_VERSION.*/PHP_VERSION=${PHP_VERSION}/" .env

docker-compose build --no-cache nginx mysql phpmyadmin php-fpm workspace

docker-compose up -d nginx mysql phpmyadmin php-fpm workspace

docker-compose exec workspace composer install 

docker-compose exec workspace php artisan migrate:fresh --seed

docker-compose exec workspace php artisan storage:link