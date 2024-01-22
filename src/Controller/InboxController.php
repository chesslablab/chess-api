<?php

namespace ChessApi\Controller;

use Chess\Exception\MovetextException;
use Chess\Movetext\SanMovetext;
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
use Chess\Variant\Classical\PGN\Move as ClassicalPgnMove;
use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InboxController extends AbstractController
{
    const ACTION_CREATE = 'create';

    const ACTION_READ = 'read';

    const ACTION_REPLY = 'reply';

    public function create(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        }

        $settings = $params['settings'] ?? [];

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
                'value' => json_encode($settings, true),
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

        if (!isset($params['hash'])) {
            throw new BadRequestHttpException();
        }

        $sql = 'SELECT * FROM inbox WHERE hash = :hash';

        $values = [
            [
                'param' => ':hash',
                'value' => $params['hash'],
                'type' => \PDO::PARAM_STR
            ],
        ];

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql, $values)
            ->fetchAll(\PDO::FETCH_ASSOC);

        if ($arr) {
            return $this->json($arr);
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }

    public function reply(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['hash'])) {
            throw new BadRequestHttpException();
        }
        if (!isset($params['movetext'])) {
            throw new BadRequestHttpException();
        }

        $sql = 'SELECT * FROM inbox WHERE hash = :hash';

        $values = [
            [
                'param' => ':hash',
                'value' => $params['hash'],
                'type' => \PDO::PARAM_STR
            ],
        ];

        $arr = Pdo::getInstance($this->getParameter('pdo'))
            ->query($sql, $values)
            ->fetchAll(\PDO::FETCH_ASSOC);

        if ($arr) {
            $inbox = current($arr);
            $settings = json_decode($inbox['settings'], true);

            if (isset($settings['fen'])) {
                if ($inbox['variant'] === Chess960Board::VARIANT) {
                   $move = new ClassicalPgnMove();
                   $startPos = str_split($inbox['settings']['startPos']);
                   $board = (new Chess960FenStrToBoard($inbox['settings']['fen'], $startPos))
                       ->create();
               } elseif ($inbox['variant'] === CapablancaBoard::VARIANT) {
                   $move = new CapablancaPgnMove();
                   $board = (new CapablancaFenStrToBoard($inbox['settings']['fen']))
                       ->create();
               } elseif ($inbox['variant'] === CapablancaFischerBoard::VARIANT) {
                   $move = new CapablancaPgnMove();
                   $startPos = str_split($inbox['settings']['startPos']);
                   $board = (new CapablancaFischerFenStrToBoard($inbox['settings']['fen'], $startPos))
                       ->create();
               } else {
                   $move = new ClassicalPgnMove();
                   $board = (new ClassicalFenStrToBoard($inbox['settings']['fen']))
                       ->create();
               }
            } else {
                if ($inbox['variant'] === Chess960Board::VARIANT) {
                    $move = new ClassicalPgnMove();
                    $startPos = (new Chess960StartPosition())->create();
                    $board = new Chess960Board($startPos);
                } elseif ($inbox['variant'] === CapablancaBoard::VARIANT) {
                    $move = new CapablancaPgnMove();
                    $board = new CapablancaBoard();
                } elseif ($inbox['variant'] === CapablancaFischerBoard::VARIANT) {
                    $move = new CapablancaPgnMove();
                    $startPos = (new CapablancaFischerStartPosition())->create();
                    $board = new CapablancaFischerBoard($startPos);
                } else {
                    $move = new ClassicalPgnMove();
                    $board = new ClassicalBoard();
                }
            }

            try {
                if ($inbox['movetext']) {
                    $san = new SanMovetext($move, $inbox['movetext']);
                    $san->validate();
                    foreach ($san->getMoves() as $key => $val) {
                        $board->play($board->getTurn(), $val);
                    }
                }
                if (!$board->play($board->getTurn(), $params['movetext'])) {
                    throw new MovetextException();
                }

                $sql = "UPDATE inbox
                    SET fen = :fen, movetext = :movetext, updatedAt = :updatedAt
                WHERE hash = :hash";

                $values = [
                    [
                        'param' => ':fen',
                        'value' => $board->toFen(),
                        'type' => \PDO::PARAM_STR
                    ],
                    [
                        'param' => ':movetext',
                        'value' => $board->getMovetext(),
                        'type' => \PDO::PARAM_STR
                    ],
                    [
                        'param' => ':updatedAt',
                        'value' => (new \DateTime())->format('Y-m-d H:i:s'),
                        'type' => \PDO::PARAM_STR
                    ],
                    [
                        'param' => ':hash',
                        'value' => $params['hash'],
                        'type' => \PDO::PARAM_STR
                    ],
                ];

                Pdo::getInstance($this->getParameter('pdo'))->query($sql, $values);

                return $this->json([
                    'action' => InboxController::ACTION_REPLY,
                    'message' =>  'Chess move successfully sent.',
                ]);
            } catch (\Exception $e) {
                return $this->json([
                    'action' => InboxController::ACTION_REPLY,
                    'message' =>  'Invalid PGN move, please try again with a different one.',
                ]);
            }
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }
}
