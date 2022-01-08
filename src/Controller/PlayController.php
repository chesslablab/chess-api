<?php

namespace App\Controller;

use Chess\Player;
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

        $status = (object) [
            'castling' => $board->getCastling(),
            'isCheck' => $board->isCheck(),
            'isMate' => $board->isMate(),
            'movetext' => $board->getMovetext(),
            'turn' => $board->getTurn(),
        ];

        return $this->json($status);
    }
}
