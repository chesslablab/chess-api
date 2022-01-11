<?php

namespace ChessApi\Tests\Integration;

use ChessApi\Pdo;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public static $pdo;

    public static function setUpBeforeClass(): void
    {
        $conf = [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
        ];

        self::$pdo = Pdo::getInstance($conf);
    }

    /**
     * @test
     */
    public function count_all()
    {
        $sql = 'SELECT * FROM games';
        $result = self::$pdo->query($sql)->fetchAll();
        $expected = 402976;

        $this->assertEquals($expected, count($result));
    }
}
