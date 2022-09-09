#!/bin/bash

read -p "This will bootstrap the production environment. Are you sure to continue? (y|n) " -n 1 -r
echo    # (optional) move to a new line
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    exit 1
fi

# cd the app's root directory
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
APP_PATH="$(dirname $DIR)"
cd $APP_PATH

docker exec -itu 1000:1000 chess_api_php_fpm composer install
docker-compose up -d

# update the .env file with the container's ip
IP_ADDRESS="$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' chess_data_mysql)"
sed -i "s/DB_HOST=.*/DB_HOST=${IP_ADDRESS}/g" .env
