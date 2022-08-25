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

        $sql = "SELECT * FROM games WHERE movetext LIKE '{$params['movetext']}%'";

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql)
            ->fetchAll(\PDO::FETCH_ASSOC);

        if ($arr) {
            shuffle($arr);
            $moves = array_filter(
                explode(' ', str_replace($params['movetext'], '', $arr[0]['movetext']))
            );
            $current = explode('.', current($moves));
            return $this->json([
                'pgn' => isset($current[1]) ? $current[1] : $current[0],
            ]);
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }
}
