<?php

namespace ChessApi\Controller;

use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AutocompletePlayerController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['White']) && !isset($params['Black'])) {
            throw new BadRequestHttpException();
        }

        $key = key($params);

        $values[] = [
            'param' => ":$key",
            'value' => '%'. current($params) .'%',
            'type' => \PDO::PARAM_STR,
        ];

        $sql = "SELECT DISTINCT $key FROM games WHERE $key LIKE :$key LIMIT 10";

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql, $values)
            ->fetchAll(\PDO::FETCH_COLUMN);

        if ($arr) {
            return $this->json($arr);
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }
}
