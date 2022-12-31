<?php

namespace ChessApi\Controller;

use Chess\Game;
use Chess\Player\LanPlayer;
use Chess\Variant\Capablanca80\Board as Capablanca80Board;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlayLanController extends AbstractController
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
            $params['variant'] !== Game::VARIANT_960 &&
            $params['variant'] !== Game::VARIANT_CAPABLANCA_80 &&
            $params['variant'] !== Game::VARIANT_CLASSICAL
        ) {
            throw new BadRequestHttpException();
        }

        if ($params['variant'] === Game::VARIANT_960) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        if ($params['variant'] === Game::VARIANT_960) {
            $startPos = str_split($params['startPos']);
            $board = new Chess960Board($startPos);
        } elseif ($params['variant'] === Game::VARIANT_CAPABLANCA_80) {
            $board = new Capablanca80Board();
        } elseif ($params['variant'] === Game::VARIANT_CLASSICAL) {
            $board = new ClassicalBoard();
        }

        try {
            $board = (new LanPlayer($params['movetext'], $board))
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
