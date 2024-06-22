<?php

namespace ChessApi\Controller;

use Chess\FenToBoardFactory;
use Chess\Tutor\GoodPgnEvaluation;
use Chess\UciEngine\UciEngine;
use Chess\UciEngine\Details\Limit;
use Chess\Variant\Classical\Board;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TutorGoodMoveController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['fen'])) {
            throw new BadRequestHttpException();
        }

        $board = FenToBoardFactory::create($params['fen'], new Board());

        $limit = new Limit();
        $limit->depth = 12;

        $stockfish = new UciEngine('/usr/games/stockfish');

        $goodPgnEvaluation = new GoodPgnEvaluation($limit, $stockfish, $board);

        return $this->json([
            'pgn' => $goodPgnEvaluation->pgn,
            'paragraph' => implode(' ', $goodPgnEvaluation->paragraph),
        ]);
    }
}
