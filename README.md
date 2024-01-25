## PHP Chess API

Symfony API using the PHP Chess library.

### Documentation

Read the latest docs [here](https://php-chess-api.chesslablab.org/).

### Installation

Install the Composer packages:
```
composer install
```

Create an `.env` file:

```
cp .env.example .env
```

### Run the Chess API

There is an easy quick way to get the Chess API up and running without an SSL certificate for when testing endpoints that don't require a database connection, e.g., `POST /api/download/image`. In such cases use [PHP's built-in web server](https://www.php.net/manual/en/features.commandline.webserver.php) as described next.

```
cd public
```
```
php -S localhost:8000
```

### Run the Chess API on a Docker Container

Alternatively, you may want to run it on a Docker container but first things first, make sure to have created the `fullchain.pem` and `privkey.pem` files into the `docker/nginx/ssl` folder.

#### Development

Allow connections from https://ui.chesslablab.org:9443 only.

```
docker compose -f docker-compose.dev.yml up -d
```

#### Staging

Allow connections from any origin.

```
docker compose -f docker-compose.staging.yml up -d
```

#### Production

Allow connections from https://ui.chesslablab.org only.

```
docker compose -f docker-compose.prod.yml up -d
```

### File Permissions Setup

Set up permissions for the `var` directory:

```
sudo chown www-data:$USER -R var
sudo chmod 775 -R var
```

Set up permissions for the `storage` directory:

```
sudo chown www-data:$USER -R storage
sudo chmod 775 -R storage
```

### Contributions

See the [contributing guidelines](https://github.com/chesslablab/chess-api/blob/main/CONTRIBUTING.md).

Happy learning and coding!

<a href="https://github.com/chesslablab/chess-api/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=chesslablab/chess-api" />
</a>

Made with [contrib.rocks](https://contrib.rocks).
