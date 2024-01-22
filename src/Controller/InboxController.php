<?php

namespace ChessApi\Controller;

use Chess\Variant\Capablanca\Board as CapablancaBoard;
use Chess\Variant\Capablanca\FEN\StrToBoard as CapablancaFenStrToBoard;
use Chess\Variant\Capablanca\PGN\Move as CapablancaPgnMove;
use Chess\Variant\CapablancaFischer\Board as CapablancaFischerBoard;
use Chess\Variant\CapablancaFischer\StartPosition as CapablancaFischerStartPosition;
use Chess\Variant\CapablancaFischer\FEN\StrToBoard as CapablancaFischerFenStrToBoard;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Chess960\StartPosition as Chess960StartPosition;
use Chess\Variant\Chess960\FEN\StrToBoard as Chess960FenStrToBoard;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Chess\Variant\Classical\FEN\StrToBoard as ClassicalFenStrToBoard;
use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InboxController extends AbstractController
{
    public function create(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        }

        $settings = isset($params['settings'])
            ? json_decode(stripslashes($params['settings']), true)
            : '{}';

        $hash = md5(uniqid());

        try {
           if ($params['variant'] === Chess960Board::VARIANT) {
               $startPos = str_split($settings['startPos']);
               $fen = $settings['fen'] ?? (new Chess960Board($startPos))->toFen();
               $board = (new Chess960FenStrToBoard($fen, $startPos))->create();
           } elseif ($params['variant'] === CapablancaBoard::VARIANT) {
               $fen = $settings['fen'] ?? (new CapablancaBoard())->toFen();
               $board = (new CapablancaFenStrToBoard($fen))->create();
           } elseif ($params['variant'] === CapablancaFischerBoard::VARIANT) {
               $startPos = str_split($settings['startPos']);
               $fen = $settings['fen'] ?? (new CapablancaFischerBoard($startPos))->toFen();
               $board = (new CapablancaFischerFenStrToBoard($fen, $startPos))->create();
           } else {
               $fen = $settings['fen'] ?? (new ClassicalBoard())->toFen();
               $board = (new ClassicalFenStrToBoard($fen))->create();
           }
        } catch (\Exception $e) {
            throw new BadRequestHttpException();
        }

        $sql = "INSERT INTO inbox (hash, variant, settings, fen, movetext)
            VALUES (:hash, :variant, :settings, :fen, :movetext)";

        $values = [
            [
                'param' => ':hash',
                'value' => $hash,
                'type' => \PDO::PARAM_STR
            ],
            [
                'param' => ':variant',
                'value' => $params['variant'],
                'type' => \PDO::PARAM_STR
            ],
            [
                'param' => ':settings',
                'value' => $settings,
                'type' => \PDO::PARAM_STR
            ],
            [
                'param' => ':fen',
                'value' => $fen,
                'type' => \PDO::PARAM_STR
            ],
            [
                'param' => ':movetext',
                'value' => '',
                'type' => \PDO::PARAM_STR
            ],
        ];

        Pdo::getInstance($this->getParameter('pdo'))->query($sql, $values);

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }

    public function read(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        print_r($params); exit;
    }

    public function reply(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        print_r($params); exit;
    }
}
