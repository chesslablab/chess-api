## Chess API

API using [PHP Chess](https://github.com/chesslablab/php-chess).

### Documentation

Read the latest docs [here](https://www.chesslablab.com/documentation/).

### Installation

Clone the `chesslablab/chess-api` repo into your projects folder as it is described in the following example:

    $ git clone git@github.com:chesslablab/chess-api.git

Then `cd` the `chess-api` directory and install the Composer dependencies:

    $ composer install

Create an `.env` file:

    $ cp .env.example .env

In order to setup the Chess API you may want to configure your own web server and database or use Docker if you prefer. For further information, read the [`bash/start.sh`](https://github.com/chesslablab/chess-data/blob/master/bash/start.sh) script and check out the [`docker`](https://github.com/chesslablab/chess-api/tree/main/docker) folder.

An SSL certificate needs to be created and setup for the web server. The next posts explain how to create a certificate for the [Chess Server](https://github.com/chesslablab/chess-server), however, the steps to follow are almost identical as those for the Chess API.

- [Creating a Local WebSocket Server With TLS/SSL Is Easy as Pie](https://medium.com/geekculture/creating-a-local-websocket-server-with-tls-ssl-is-easy-as-pie-de1a2ef058e0)
- [A Simple Example of SSL/TLS WebSocket With ReactPHP and Ratchet](https://medium.com/geekculture/a-simple-example-of-ssl-tls-websocket-with-reactphp-and-ratchet-e03be973f521)

The Chess API goes hand in hand with [Chess Data](https://github.com/chesslablab/chess-data) which is a database, data science and machine learning repository. Setup the database accordingly and [seed the tables with data](https://github.com/chesslablab/chess-data/tree/master/cli#seed-the-tables-with-data).

Also there is an easy quick way to get the API up and running without an SSL certificate for when testing endpoints that don't require a database connection, e.g., `api/download_image` or `api/download_mp4`. In such cases you may want to use [PHP's built-in web server](https://www.php.net/manual/en/features.commandline.webserver.php) as described next.

```
$ cd public
$ php -S localhost:8000
```

### File Permissions Setup

Make sure the `var` directory exists:

```
$ mkdir var
```

And set up the following permissions:

```
$ sudo chown www-data:standard -R var
$ sudo chmod 775 -R var
```

Finally, set up the following permissions for the `storage` directory:

```
$ sudo chown www-data:standard -R storage
$ sudo chmod 775 -R storage
```

### Contributions

See the [contributing guidelines](https://github.com/chesslablab/chess-api/blob/main/CONTRIBUTING.md).

Happy learning and coding! Thank you, and keep it up.
