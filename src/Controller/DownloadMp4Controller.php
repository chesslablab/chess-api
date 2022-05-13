<?php

namespace ChessApi\Controller;

use Chess\Movetext;
use Chess\Player;
use Chess\Media\BoardToMp4;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DownloadMp4Controller extends AbstractController
{
    const OUTPUT_FOLDER = __DIR__.'/../../storage/tmp';

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if ($movetext = (new Movetext($params['movetext']))->validate()) {
            try {
                $board = (new Player($movetext))->play()->getBoard();
                $filename = (new BoardToMp4($board))->output(self::OUTPUT_FOLDER);
                $request->attributes->set('filename', $filename);
                return  new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
            } catch (\Exception $e) {
                return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return (new Response())->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}
