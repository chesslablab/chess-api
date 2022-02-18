<?php

namespace ChessApi\Controller;

use Chess\FEN\StringToBoard;
use Chess\Media\BoardToPng;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DownloadImageController extends AbstractController
{
    const OUTPUT_FOLDER = __DIR__.'/../../storage/tmp';

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        try {
            $board = (new StringToBoard($params['fen']))->create();
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        try {
            $filename = (new BoardToPng($board))->output(self::OUTPUT_FOLDER);
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
    }
}
