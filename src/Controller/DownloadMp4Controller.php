<?php

namespace ChessApi\Controller;

use Chess\Game;
use Chess\Movetext;
use Chess\Media\BoardToMp4;
use Chess\Player\PgnPlayer;
use Chess\Variant\Capablanca80\Board as Capablanca80Board;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DownloadMp4Controller extends AbstractController
{
    const MAX_MOVES = 300;

    const OUTPUT_FOLDER = __DIR__.'/../../storage/tmp';

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        } elseif ($params['variant'] === Game::VARIANT_960) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        if (!isset($params['movetext'])) {
            throw new BadRequestHttpException();
        } else {
            $movetext = new Movetext($params['movetext']);
            if (!$movetext->validate()) {
                throw new BadRequestHttpException();
            }
            $count = count($movetext->getMovetext()->moves);
            if ($count > self::MAX_MOVES) {
                throw new BadRequestHttpException();
            }
        }

        try {
            if ($params['variant'] === Game::VARIANT_960) {
                $startPos = str_split($params['startPos']);
                $board960 = new Chess960Board($startPos);
                $board = (new PgnPlayer($movetext, $board960))->play()->getBoard();
            } elseif ($params['variant'] === Game::VARIANT_CAPABLANCA_80) {
                $capablancaBoard = new Capablanca80Board();
                $board = (new PgnPlayer($movetext, $capablancaBoard))->play()->getBoard();
            } elseif ($params['variant'] === Game::VARIANT_CLASSICAL) {
                $board = (new PgnPlayer($movetext))->play()->getBoard();
            }
            $filename = (new BoardToMp4($board))->output(self::OUTPUT_FOLDER);
            $request->attributes->set('filename', $filename);
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return  new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
    }
}
