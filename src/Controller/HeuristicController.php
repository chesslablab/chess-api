<?php

namespace ChessApi\Controller;

use Chess\SanHeuristic;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Chess960\FEN\StrToBoard as Chess960FenStrToBoard;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Chess\Variant\Classical\FEN\StrToBoard as ClassicalFenStrToBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class HeuristicController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        } elseif ($params['variant'] === Chess960Board::VARIANT) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        if (!isset($params['movetext'])) {
            throw new BadRequestHttpException();
        }

        if (!isset($params['name'])) {
            throw new BadRequestHttpException();
        }

        if ($params['variant'] === Chess960Board::VARIANT) {
            $startPos = str_split($params['startPos']);
            $board = isset($params['fen'])
                ? (new Chess960FenStrToBoard($params['fen'], $startPos))->create()
                : new Chess960Board($startPos);
        } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
            $board = isset($params['fen'])
                ? (new ClassicalFenStrToBoard($params['fen']))->create()
                : new ClassicalBoard();
        }

        $balance = (new SanHeuristic($params['name'], $params['movetext'], $board))
            ->getBalance();

        return $this->json($balance);
    }
}
