<?php

namespace ChessApi\Controller;

use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StatsEventController extends AbstractController
{
    const SQL_LIKE = [

    ];

    const SQL_EQUAL = [
        'Event',
        'Result',
    ];

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        $sql = 'SELECT ECO, COUNT(*) as total FROM games WHERE ';
        $values = [];

        foreach ($params as $key => $val) {
            if (in_array($key, self::SQL_LIKE)) {
                $sql .= "$key LIKE :$key AND ";
                $values[] = [
                    'param' => ":$key",
                    'value' => '%'.$val.'%',
                    'type' => \PDO::PARAM_STR,
                ];
            } else if (in_array($key, self::SQL_EQUAL) && $val) {
                $sql .= "$key = :$key AND ";
                $values[] = [
                    'param' => ":$key",
                    'value' => $val,
                    'type' => \PDO::PARAM_STR,
                ];
            }
        }

        str_ends_with($sql, 'WHERE ')
            ? $sql = substr($sql, 0, -6)
            : $sql = substr($sql, 0, -4);

        $sql .= 'GROUP BY ECO ORDER BY total DESC';

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql, $values)
            ->fetchAll(\PDO::FETCH_ASSOC);

        if ($arr) {
            return $this->json($arr);
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
