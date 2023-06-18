<?php

namespace ChessApi\Controller;

use Chess\Media\BoardToMp4;
use Chess\Variant\Capablanca\Board as CapablancaBoard;
use Chess\Variant\Capablanca\FEN\StrToBoard as CapablancaFenStrToBoard;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Chess960\FEN\StrToBoard as Chess960FenStrToBoard;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Chess\Variant\Classical\FEN\StrToBoard as ClassicalFenStrToBoard;
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
        } elseif ($params['variant'] === Chess960Board::VARIANT) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        if (!isset($params['flip'])) {
            throw new BadRequestHttpException();
        }

        try {
            if ($params['fen']) {
                if ($params['variant'] === Chess960Board::VARIANT) {
                    $board = (new Chess960FenStrToBoard($params['fen'], $params['startPos']))
                        ->create();
                } elseif ($params['variant'] === CapablancaBoard::VARIANT) {
                    $board = (new CapablancaFenStrToBoard($params['fen']))
                        ->create();
                } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
                    $board = (new ClassicalFenStrToBoard($params['fen']))
                        ->create();
                } else {
                    throw new BadRequestHttpException();
                }
            } else {
                if ($params['variant'] === Chess960Board::VARIANT) {
                    $board = new Chess960Board($params['startPos']);
                } elseif ($params['variant'] === CapablancaBoard::VARIANT) {
                    $board = new CapablancaBoard();
                } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
                    $board = new ClassicalBoard();
                } else {
                    throw new BadRequestHttpException();
                }
            }

            $filename = (new BoardToMp4(
                $params['movetext'],
                $board,
                $flip = $params['flip']
            ))->output(self::OUTPUT_FOLDER);

            $request->attributes->set('filename', $filename);
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return  new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
    }
}
