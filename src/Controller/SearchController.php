<?php

namespace ChessApi\Controller;

use Chess\Movetext\SanMovetext;
use Chess\Variant\Classical\PGN\Move;
use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SearchController extends AbstractController
{
    const SQL_LIKE = [
        'Date',
        'movetext',
    ];

    const SQL_EQUAL = [
        'Event',
        'White',
        'Black',
        'ECO',
        'Result',
    ];

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        try {
            if (isset($params['movetext'])) {
                $sanMovetext = (new SanMovetext(
                    new Move(),
                    $params['movetext']
                ))->validate();
            }
        } catch (\Exception $e) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
            return $response;
        }

        $sql = 'SELECT * FROM players WHERE ';
        $values = [];

        foreach ($params as $key => $val) {
            if ($val) {
                if (in_array($key, self::SQL_LIKE)) {
                    $sql .= "$key LIKE :$key AND ";
                    if ($key === 'movetext') {
                        $val = $sanMovetext;
                    }
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
        }

        str_ends_with($sql, 'WHERE ')
            ? $sql = substr($sql, 0, -6)
            : $sql = substr($sql, 0, -4);

        $sql .= 'ORDER BY RAND() LIMIT 25';

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql, $values)
            ->fetchAll(\PDO::FETCH_ASSOC);

        if ($arr) {
            return $this->json($arr);
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }
}
