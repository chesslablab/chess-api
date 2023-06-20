<?php

namespace ChessApi\Controller;

use Chess\Play\LAN;
use Chess\UciEngine\Stockfish;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EngineStockfishController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['movetext'])) {
            throw new BadRequestHttpException();
        }

        if (!isset($params['skillLevel'])) {
            throw new BadRequestHttpException();
        }

        if (!isset($params['depth'])) {
            throw new BadRequestHttpException();
        }

        try {
            $board = (new LAN($params['movetext'], new ClassicalBoard()))
                ->play()
                ->getBoard();

            $stockfish = (new Stockfish($board))
                ->setOptions([
                    'Skill Level' => $params['skillLevel'],
                ])
                ->setParams([
                    'depth' => $params['depth'],
                ]);

            $lan = $stockfish->play($board->toFen());
            $board->playLan($board->getTurn(), $lan);
        } catch (\Exception $e) {
            throw new BadRequestHttpException();
        }

        $arr = [
            'move' => $lan,
            'fen' => $board->toFen(),
            'isCheck' => $board->isCheck(),
            'isMate' => $board->isMate(),
            'movetext' => $board->getMovetext(),
        ];

        return $this->json($arr);
    }
}
