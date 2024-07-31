# Installation

Clone the `chesslablab/chess-api` repo into your projects folder. Then `cd` the `chess-api` directory and create an `.env` file:

```text
cp .env.example .env
```

Make sure to have installed the `fullchain.pem` and `privkey.pem` files into the `docker/nginx/ssl` folder, and run the Docker containers in detached mode in the background:

```txt
docker compose -f docker-compose.default.yml up -d
```

Finally, if you are running the chess API in a local development environment along with the [website](https://github.com/chesslablab/website), you may want to add a domain name entry to your `/etc/hosts` file as per the `API` variable defined in the [assets/env.example.js](https://github.com/chesslablab/website/blob/main/assets/env.example.js) file.

```txt
127.0.0.1       api.chesslablab.org
```
