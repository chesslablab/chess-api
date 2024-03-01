# Installation

## Setup

Clone the `chesslablab/chess-api` repo into your projects folder. Then `cd` the `chess-api` directory and install the Composer dependencies:

```text
composer install
```

Create an `.env` file:

```text
cp .env.example .env
```

## File Permissions

Set up permissions for the `var` directory:

```text
sudo chown www-data:$USER -R var
sudo chmod 775 -R var
```

Set up permissions for the `storage` directory:

```text
sudo chown www-data:$USER -R storage
sudo chmod 775 -R storage
```

## Run the API

There is an easy quick way to get the Chess API up and running without an SSL certificate for when testing endpoints that don't require a database connection, e.g., `POST /v1/api/download/image`. In such cases use [PHP's built-in web server](https://www.php.net/manual/en/features.commandline.webserver.php) as described next.

```text
cd public
```

```text
php -S localhost:8000
```

## Run the API on a Docker Container

Alternatively, you may want to run it on a Docker container but first things first, make sure to have created the `fullchain.pem` and `privkey.pem` files into the `docker/nginx/ssl` folder.

### Development

Allow connections from https://ui.chesslablab.org:9443 only.

```text
docker compose -f docker-compose.dev.yml up -d
```

### Staging

Allow connections from any origin.

```text
docker compose -f docker-compose.staging.yml up -d
```

### Production

Allow connections from https://ui.chesslablab.org only.

```text
docker compose -f docker-compose.prod.yml up -d
```
