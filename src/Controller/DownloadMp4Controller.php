<?php

namespace ChessApi\Controller;

use Chess\Media\BoardToMp4;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Chess960\FEN\StrToBoard as Chess960FenStrToBoard;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Chess\Variant\Classical\FEN\StrToBoard as ClassicalFenStrToBoard;
use Chess\Variant\Classical\PGN\AN\Color;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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
            if (isset($params['fen'])) {
                if ($params['variant'] === Chess960Board::VARIANT) {
                    $startPos = str_split($params['startPos']);
                    $board = (new Chess960FenStrToBoard($params['fen'], $startPos))
                        ->create();
                } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
                    $board = (new ClassicalFenStrToBoard($params['fen']))
                        ->create();
                } else {
                    throw new BadRequestHttpException();
                }
            } else {
                if ($params['variant'] === Chess960Board::VARIANT) {
                    $startPos = str_split($params['startPos']);
                    $board = new Chess960Board($startPos);
                } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
                    $board = new ClassicalBoard();
                } else {
                    throw new BadRequestHttpException();
                }
            }

            $filename = (new BoardToMp4(
                $params['movetext'],
                $board,
                $params['flip'] === Color::B
            ))->output(self::OUTPUT_FOLDER);

            $request->attributes->set('filename', $filename);
        } catch (\Exception $e) {
            return (new Response())->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response = new BinaryFileResponse(self::OUTPUT_FOLDER.'/'.$filename);
        $response->headers->set('Content-Type', 'video/mp4');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'chessgame.mp4'
        );

        return $response;
    }
}
