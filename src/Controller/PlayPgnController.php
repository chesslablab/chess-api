<?php

namespace ChessApi\Controller;

use Chess\Play\SAN;
use Chess\Variant\Capablanca\Board as CapablancaBoard;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlayPgnController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['movetext'])) {
            throw new BadRequestHttpException();
        }

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        }

        if (
            $params['variant'] !== Chess960Board::VARIANT &&
            $params['variant'] !== CapablancaBoard::VARIANT &&
            $params['variant'] !== ClassicalBoard::VARIANT
        ) {
            throw new BadRequestHttpException();
        }

        if ($params['variant'] === Chess960Board::VARIANT) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        if ($params['variant'] === Chess960Board::VARIANT) {
            $startPos = str_split($params['startPos']);
            $board = new Chess960Board($startPos);
        } elseif ($params['variant'] === CapablancaBoard::VARIANT) {
            $board = new CapablancaBoard();
        } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
            $board = new ClassicalBoard();
        }

        try {
            $board = (new SAN($params['movetext'], $board))
                ->play()
                ->getBoard();
        } catch (\Exception $e) {
            throw new BadRequestHttpException();
        }

        $arr = [
            'fen' => $board->toFen(),
            'isCheck' => $board->isCheck(),
            'isMate' => $board->isMate(),
            'movetext' => $board->getMovetext(),
        ];

        return $this->json($arr);
    }
}
