<?php

namespace App\Controller;

use Chess\Player;
use Chess\FEN\BoardToString;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        $player = new Player($params['movetext']);

        $board = $player->play()->getBoard();

        $response = [
            'fen' => (new BoardToString($board))->create(),
            'isCheck' => $board->isCheck(),
            'isMate' => $board->isMate(),
            'movetext' => $board->getMovetext(),
        ];

        return $this->json($response);
    }
}
