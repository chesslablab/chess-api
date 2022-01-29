## Chess API

A chess REST API.

### Documentation

Read the latest docs [here](https://app.swaggerhub.com/apis-docs/chesslablab/chess-rest_api/1.0.0).

### Installation

Clone the `chesslablab/chess-api` repo into your projects folder as it is described in the following example:

    $ git clone git@github.com:chesslablab/chess-api.git

Then `cd` the `chess-api` directory and install the Composer dependencies:

    $ composer install

Create an `.env` file:

    $ cp .env.example .env

If necessary, update the environment variables in your `.env` file.

The Chess REST API goes hand in hand with [Chess Data](https://github.com/chesslablab/chess-data) which is a database, data science and machine learning repository. It is a precondition for the API to operate properly to first [setup the Chess Data repo](https://github.com/chesslablab/chess-data#setup), and then create and seed the chess database with data. Having said that, you may want to go your own adventure in terms of configuring a web server along with a MySQL server, or use Docker if you prefer.

Described below are the steps to get the Chess REST API up and running with Docker.

#### Start the Chess Data Containers

`cd` your `~/projects/chess-data` and run:

```
$ bash/prod/start.sh
This will bootstrap the production environment. Are you sure to continue? (y|n) y
```

The bash script will create the `chess_data_mysql` and `chess_data_php_fpm` containers:

```
$ docker ps -a
CONTAINER ID   IMAGE                COMMAND                  CREATED          STATUS          PORTS                                                  NAMES
092ec0757601   mysql:8.0            "docker-entrypoint.s…"   10 minutes ago   Up 10 minutes   0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/tcp   chess_data_mysql
5bf471066735   chess-data_php_fpm   "docker-php-entrypoi…"   10 minutes ago   Up 10 minutes   9000/tcp                                               chess_data_php_fpm
```

As well as the `chess-data_default` network:

```
$ docker network ls
NETWORK ID     NAME                 DRIVER    SCOPE
e70c00029afb   bridge               bridge    local
936d496d81bb   chess-data_default   bridge    local
3a4db4d71d51   host                 host      local
ffe89efcb84e   none                 null      local
```

> Please notice that if restarting your computer, the `DB_HOST` in your `.env` file may need to be updated with the new IP of the `chess_data_mysql` container. For further information, read the [`bash/prod/start.sh`](https://github.com/chesslablab/chess-data/blob/master/bash/prod/start.sh) script.

```
$ IP_ADDRESS="$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' chess_data_mysql)"
$ sed -i "s/DB_HOST=.*/DB_HOST=${IP_ADDRESS}/g" .env
```

#### Create and Seed the Chess Database With Data

Let's now create the database and seed some tables with data.

```
$ docker exec -itu 1000:1000 chess_data_php_fpm php cli/db-create.php
$ docker exec -itu 1000:1000 chess_data_php_fpm php cli/seed/openings.php
$ docker exec -itu 1000:1000 chess_data_php_fpm php cli/seed/games.php data/players/Carlsen.pgn
$ docker exec -itu 1000:1000 chess_data_php_fpm php cli/seed/games.php data/players/PolgarJ.pgn
```

#### Start the Chess API Containers

First things first, make sure to create and install an SSL certificate in the `docker/nginx/ssl` folder as described next:

- [Creating a Local WebSocket Server With TLS/SSL Is Easy as Pie](https://medium.com/geekculture/creating-a-local-websocket-server-with-tls-ssl-is-easy-as-pie-de1a2ef058e0)
- [A Simple Example of SSL/TLS WebSocket With ReactPHP and Ratchet](https://medium.com/geekculture/a-simple-example-of-ssl-tls-websocket-with-reactphp-and-ratchet-e03be973f521)

> These posts explain how to create a certificate for a Chess Server, however, the steps are pretty much identical to create an SSL certificate for the Chess API.

The thing is, a certificate needs to be installed — otherwise nginx will exit with code 1.

```
...
chess_api_nginx exited with code 1
chess_api_nginx | /docker-entrypoint.sh: Configuration complete; ready for start up
chess_api_nginx | 2022/01/28 17:28:55 [emerg] 1#1: cannot load certificate "/etc/nginx/ssl/certificate.crt": PEM_read_bio_X509_AUX() failed (SSL: error:0909006C:PEM routines:get_name:no start line:Expecting: TRUSTED CERTIFICATE)
chess_api_nginx | nginx: [emerg] cannot load certificate "/etc/nginx/ssl/certificate.crt": PEM_read_bio_X509_AUX() failed (SSL: error:0909006C:PEM routines:get_name:no start line:Expecting: TRUSTED CERTIFICATE)
chess_api_nginx exited with code 1
```

Thus, here is how the folder structure looks like after the certificate has been created.

```
🗁 docker
  🗁 nginx
    🗁 ssl
      🗎 ca_bundle.crt
      🗎 certificate.crt
      🗎 private.key
```

Then, `cd` your `~/projects/chess-api` and run:

```
$ bash/prod/start.sh
This will bootstrap the production environment. Are you sure to continue? (y|n) y
```

The bash script will create the `chess_api_php_fpm` and `chess_api_nginx` containers:

```
$ docker ps -a
CONTAINER ID   IMAGE                COMMAND                  CREATED          STATUS          PORTS                                                  NAMES
6c1aa4ce9886   chess-api_php_fpm    "docker-php-entrypoi…"   32 seconds ago   Up 29 seconds   9000/tcp                                               chess_api_php_fpm
1ada37d4a794   nginx:1.20           "/docker-entrypoint.…"   32 seconds ago   Up 28 seconds   80/tcp, 0.0.0.0:443->443/tcp, :::443->443/tcp          chess_api_nginx
1db2e7e758ec   chess-data_php_fpm   "docker-php-entrypoi…"   2 hours ago      Up 6 minutes    9000/tcp                                               chess_data_php_fpm
7b839bce2d58   mysql:8.0            "docker-entrypoint.s…"   2 hours ago      Up 6 minutes    0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/tcp   chess_data_mysql
```

#### Test the API Endpoints

Find out the IP of the `chess_api_nginx` container as it is described in the following example:

```
$ docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' chess_api_nginx
172.19.0.4
```

And finally add this entry in your `/etc/hosts` file:

```
172.19.0.4      pchess.net
```
![Figure 1](/docs/figure-01.png)
**Figure 1**. Example of `GET /api/docs` request

![Figure 2](/docs/figure-02.png)
**Figure 2**. Example of `POST /api/grandmaster` request

![Figure 3](/docs/figure-03.png)
**Figure 3**. Example of `POST /api/opening` request

![Figure 4](/docs/figure-04.png)
**Figure 4**. Example of `POST /api/play` request

### Contributions

See the [contributing guidelines](https://github.com/chesslablab/chess-api/blob/main/CONTRIBUTING.md).

Happy learning and coding! Thank you, and keep it up.
