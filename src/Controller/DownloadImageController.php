<?php

namespace ChessApi\Controller;

use Chess\Media\BoardToPng;
use Chess\Variant\Capablanca\Board as CapablancaBoard;
use Chess\Variant\Capablanca\FEN\StrToBoard as CapablancaStrToBoard;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Classical\Board as ClassicalBoard;
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
            if ($params['variant'] === Chess960Board::VARIANT) {
                $board = (new ClassicalStrToBoard($params['fen']))->create();
            } elseif ($params['variant'] === CapablancaBoard::VARIANT) {
                $board = (new CapablancaStrToBoard($params['fen']))->create();
            } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
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
