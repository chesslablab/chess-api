<?php

namespace ChessApi\Controller;

use Chess\Player;
use Chess\FEN\BoardToString;
use Chess\Exception\MovetextException;
use Chess\Exception\UnknownNotationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlayController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        try {
            $board = (new Player($params['movetext']))->play()->getBoard();
        } catch (MovetextException $e) {
            throw new BadRequestHttpException($e->getMessage());
        } catch (UnknownNotationException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $response = [
            'fen' => (new BoardToString($board))->create(),
            'isCheck' => $board->isCheck(),
            'isMate' => $board->isMate(),
            'movetext' => $board->getMovetext(),
        ];

        return $this->json($response);
    }
}
