<?php

namespace ChessApi\Controller;

use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StatsOpeningController extends AbstractController
{
    public function index(Request $request): Response
    {
        $sql = "SELECT ECO, COUNT(*) AS total
            FROM games
            WHERE Result = '1/2-1/2'
            GROUP BY ECO
            HAVING total >= 100
            ORDER BY total DESC
            LIMIT 50";

        $drawRate = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql)
            ->fetchAll(\PDO::FETCH_ASSOC);

        $sql = "SELECT ECO, COUNT(*) AS total
            FROM games
            WHERE Result = '1-0'
            GROUP BY ECO
            HAVING total >= 100
            ORDER BY total DESC
            LIMIT 50";

        $winRateForWhite = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql)
            ->fetchAll(\PDO::FETCH_ASSOC);

        $sql = "SELECT ECO, COUNT(*) AS total
            FROM games
            WHERE Result = '0-1'
            GROUP BY ECO
            HAVING total >= 100
            ORDER BY total DESC
            LIMIT 50";

        $winRateForBlack = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql)
            ->fetchAll(\PDO::FETCH_ASSOC);

        $content = json_encode([
            'drawRate' => $drawRate,
            'winRateForWhite' => $winRateForWhite,
            'winRateForBlack' => $winRateForBlack
        ]);

        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
