<?php

namespace ChessApi\Controller;

use Chess\FenToBoardFactory;
use Chess\Play\RavPlay;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlayRavController extends AbstractController
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
            $params['variant'] !== ClassicalBoard::VARIANT
        ) {
            throw new BadRequestHttpException();
        }

        if ($params['variant'] === Chess960Board::VARIANT) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        try {
            if ($params['variant'] === Chess960Board::VARIANT) {
                $startPos = str_split($params['startPos']);
                $board = new Chess960Board($startPos);
                if (isset($params['fen'])) {
                    $board = FenToBoardFactory::create($params['fen'], $board);
                }
                $ravPlay = new RavPlay($params['movetext'], $board);
            } else {
                $board = new ClassicalBoard();
                if (isset($params['fen'])) {
                    $board = FenToBoardFactory::create($params['fen'], $board);
                }
                $ravPlay = new RavPlay($params['movetext'], $board);
            }
            $board = $ravPlay->validate()->board;
        } catch (\Exception $e) {
            throw new BadRequestHttpException();
        }

        $arr = [
            'variant' => $params['variant'],
            'turn' => $board->turn,
            'filtered' => $ravPlay->ravMovetext->filtered(),
            'movetext' => $ravPlay->ravMovetext->main(),
            'breakdown' => $ravPlay->ravMovetext->breakdown,
            'fen' => $ravPlay->fen,
            ...($params['variant'] === Chess960Board::VARIANT
                ? ['startPos' =>  $params['startPos']]
                : []
            ),
        ];

        return $this->json($arr);
    }
}
