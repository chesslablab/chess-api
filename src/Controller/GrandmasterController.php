<?php

namespace ChessApi\Controller;

use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GrandmasterController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        $sql = "SELECT * FROM players WHERE movetext LIKE :movetext";

        $values[] = [
            'param' => ':movetext',
            'value' => $params['movetext'].'%',
            'type' => \PDO::PARAM_STR,
        ];

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
