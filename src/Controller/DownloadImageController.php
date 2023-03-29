<?php

namespace ChessApi\Controller;

use Chess\Game;
use Chess\Media\BoardToPng;
use Chess\Variant\Capablanca80\FEN\StrToBoard as Capablanca80StrToBoard;
use Chess\Variant\Classical\FEN\StrToBoard as ClassicalStrToBoard;
use Chess\Variant\Classical\PGN\AN\Color;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DownloadImageController extends AbstractController
{
    const OUTPUT_FOLDER = __DIR__.'/../../storage/tmp';

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        }
        if (!isset($params['fen'])) {
            throw new BadRequestHttpException();
        }
        if (!isset($params['flip'])) {
            throw new BadRequestHttpException();
        }

        try {
            if ($params['variant'] === Game::VARIANT_960) {
                $board = (new ClassicalStrToBoard($params['fen']))->create();
            } elseif ($params['variant'] === Game::VARIANT_CAPABLANCA_80) {
                $board = (new Capablanca80StrToBoard($params['fen']))->create();
            } elseif ($params['variant'] === Game::VARIANT_CLASSICAL) {
                $board = (new ClassicalStrToBoard($params['fen']))->create();
            }
            $filename = (new BoardToPng($board, $params['flip'] === Color::B))
                ->output(self::OUTPUT_FOLDER);
            $request->attributes->set('filename', $filename);
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
    }
}
