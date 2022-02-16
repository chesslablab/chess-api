<?php

namespace ChessApi\Controller;

use Chess\Player;
use Chess\Media\BoardToGif;
use Chess\PGN\Validate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DownloadGifController extends AbstractController
{
    const OUTPUT_FOLDER = __DIR__.'/../../storage/tmp';

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);
        $movetext = Validate::movetext($params['movetext']);
        $board = (new Player($movetext))->play()->getBoard();
        if ($board->getHistory()) {
            $filename = (new BoardToGif($board))->output(self::OUTPUT_FOLDER);
            $response = new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
            return $response;
        }
        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }
}
