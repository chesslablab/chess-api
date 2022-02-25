<?php

namespace ChessApi\Controller;

use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TournamentController extends AbstractController
{
    public function index(Request $request): Response
    {
        $conf = [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
        ];

        $sql = "SELECT * FROM tournaments ORDER BY RAND() LIMIT 1";

        $arr = Pdo::getInstance($conf)
            ->query($sql)
            ->fetch(\PDO::FETCH_ASSOC);

        return $this->json($arr);
    }
}
