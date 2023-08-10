<?php

namespace ChessApi\Controller;

use Chess\Heuristics;
use Chess\Variant\Capablanca\Board as CapablancaBoard;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class HeuristicsController extends AbstractController
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

        if ($params['variant'] === Chess960Board::VARIANT) {
            $startPos = str_split($params['startPos']);
            $board = new Chess960Board($startPos);
        } elseif ($params['variant'] === CapablancaBoard::VARIANT) {
            $board = new CapablancaBoard();
        } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
            $board = new ClassicalBoard();
        }

        $heuristics = new Heuristics($params['movetext'], $board);

        $arr = [
            'evalNames' => $heuristics->getEvalNames(),
            'balance' => $heuristics->getBalance(),
        ];

        return $this->json($arr);
    }
}
