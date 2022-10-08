<?php

namespace ChessApi\Controller;

use Chess\Exception\MovetextException;
use Chess\Exception\UnknownNotationException;
use Chess\Player\PgnPlayer;
use Chess\Variant\Classical\FEN\BoardToStr;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlayController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        try {
            $board = (new PgnPlayer($params['movetext']))->play()->getBoard();
        } catch (MovetextException $e) {
            throw new BadRequestHttpException($e->getMessage());
        } catch (UnknownNotationException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $arr = [
            'fen' => (new BoardToStr($board))->create(),
            'isCheck' => $board->isCheck(),
            'isMate' => $board->isMate(),
            'movetext' => $board->getMovetext(),
        ];

        return $this->json($arr);
    }
}
