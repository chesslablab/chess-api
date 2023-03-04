<?php

namespace ChessApi\Controller;

use Chess\Game;
use Chess\Media\BoardToMp4;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DownloadMp4Controller extends AbstractController
{
    const OUTPUT_FOLDER = __DIR__.'/../../storage/tmp';

    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['movetext'])) {
            throw new BadRequestHttpException();
        }

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        } elseif ($params['variant'] === Game::VARIANT_960) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        try {
            $filename = (new BoardToMp4(
                $params['variant'],
                $params['movetext'],
                $params['fen'] ?? '',
                $params['startPos'] ?? '',
                $flip = false
            ))->output(self::OUTPUT_FOLDER);
            $request->attributes->set('filename', $filename);
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return  new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
    }
}
