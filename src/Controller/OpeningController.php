<?php

namespace ChessApi\Controller;

use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OpeningController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        $isEco = isset($params['eco']);
        $isName = isset($params['name']);
        $isMovetext = isset($params['movetext']);

        if (!($isEco xor $isName xor $isMovetext)) {
            throw new BadRequestHttpException('Only one of these params is required: eco, name or movetext.');
        }

        if ($isEco) {
            $sql = "SELECT eco, name, movetext FROM openings WHERE eco LIKE '{$params['eco']}%'";
        } elseif ($isName) {
            $sql = "SELECT eco, name, movetext FROM openings WHERE name LIKE '%{$params['name']}%'";
        } elseif ($isMovetext) {
            $sql = "SELECT eco, name, movetext FROM openings WHERE movetext LIKE '%{$params['movetext']}%'";
        }

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql)
            ->fetchAll(\PDO::FETCH_ASSOC);

        return $this->json($arr);
    }
}
