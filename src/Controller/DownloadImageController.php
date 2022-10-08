<?php

namespace ChessApi\Controller;

use Chess\Media\BoardToPng;
use Chess\Player\PgnPlayer;
use Chess\Variant\Classical\FEN\StrToBoard;
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

        $isFen = isset($params['fen']);
        $isMovetext = isset($params['movetext']);

        if (!($isFen xor $isMovetext)) {
            throw new BadRequestHttpException('Only one of these params is required: fen or movetext.');
        }

        if ($isFen) {
            try {
                $board = (new StrToBoard($params['fen']))->create();
            } catch (\Exception $e) {
                return (new Response())->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        } elseif ($isMovetext) {
            try {
                $board = (new PgnPlayer($params['movetext']))->play()->getBoard();
            } catch (\Exception $e) {
                return (new Response())->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        }

        try {
            $filename = (new BoardToPng($board))->output(self::OUTPUT_FOLDER);
            $request->attributes->set('filename', $filename);
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
    }
}
