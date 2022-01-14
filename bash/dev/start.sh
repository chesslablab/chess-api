#!/bin/bash

read -p "This will bootstrap the development environment. Are you sure to continue? (y|n) " -n 1 -r
echo    # (optional) move to a new line
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    exit 1
fi

# cd the app's root directory
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
APP_PATH="$(dirname $(dirname $DIR))"
cd $APP_PATH

# generate a development SSL certificate
cd docker/nginx/ssl
openssl genrsa -des3 -passout pass:foobar -out pchess.local.pem 2048
openssl req -passin pass:foobar -new -sha256 -key pchess.local.pem -subj "/C=US/ST=CA/O=pchess, Inc./CN=pchess.local" -reqexts SAN -config <(cat /etc/ssl/openssl.cnf <(printf "[SAN]\nsubjectAltName=DNS:pchess.local,DNS:www.pchess.local")) -out pchess.local.csr
openssl x509 -passin pass:foobar -req -days 365 -in pchess.local.csr -signkey pchess.local.pem -out pchess.local.crt
openssl rsa -passin pass:foobar -in pchess.local.pem -out pchess.local.key

# install dependencies
docker exec -itu 1000:1000 chess_api_php_fpm composer install

# build the docker containers
cd $APP_PATH
docker-compose up -d
