# PHP Chess API

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/license/mit/)
[![Contributors](https://img.shields.io/github/contributors/chesslablab/chess-api)](https://github.com/chesslablab/chess-api/graphs/contributors)

PHP Chess API is a REST-like API that provides chess functionality over an HTTP connection.

Similar to the [PHP Chess Server](https://chesslablab.github.io/chess-server/), it can be hosted on a custom domain. However, while the chess server handles multiple concurrent connections based on real-time commands, the API endpoints may take a little longer to execute — for example, a file download or a database query.

The API goes hand in hand with a MySQL chess database which is to be set up as per the [Chess Data](https://chesslablab.github.io/chess-data/) docs.

## Components Based Design

The PHP Chess API has been created using the [Symfony](https://symfony.com/) framework, which is a set of reusable PHP components.

## Lightweight

Dependencies required:

- PHP Chess for chess functionality.
- PHP dotenv for loading environment variables.
