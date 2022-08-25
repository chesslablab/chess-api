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
        $sql = "SELECT * FROM tournaments ORDER BY RAND() LIMIT 1";

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql)
            ->fetch(\PDO::FETCH_ASSOC);

        return $this->json($arr);
    }
}
