<?php

namespace ChessApi\Cli;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$options = [
    'cost' => 4,
];

$hash = password_hash($_ENV['API_KEY_PASSWORD'], PASSWORD_BCRYPT, $options);

echo $hash . PHP_EOL;
