<?php

namespace ChessApi\Controller;

use Chess\Tutor\FenExplanation;
use Chess\Variant\Capablanca\Board as CapablancaBoard;
use Chess\Variant\Capablanca\FEN\StrToBoard as CapablancaFenStrToBoard;
use Chess\Variant\CapablancaFischer\Board as CapablancaFischerBoard;
use Chess\Variant\CapablancaFischer\FEN\StrToBoard as CapablancaFischerStrToBoard;
use Chess\Variant\Chess960\Board as Chess960Board;
use Chess\Variant\Chess960\FEN\StrToBoard as Chess960FenStrToBoard;
use Chess\Variant\Classical\Board as ClassicalBoard;
use Chess\Variant\Classical\FEN\StrToBoard as ClassicalFenStrToBoard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TutorFenController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['variant'])) {
            throw new BadRequestHttpException();
        } elseif ($params['variant'] === Chess960Board::VARIANT) {
            if (!isset($params['startPos'])) {
                throw new BadRequestHttpException();
            }
        }

        if (!isset($params['fen'])) {
            throw new BadRequestHttpException();
        }

        if ($params['variant'] === Chess960Board::VARIANT) {
            $startPos = str_split($params['startPos']);
            $board = (new Chess960FenStrToBoard($params['fen'], $startPos))->create();
        } elseif ($params['variant'] === CapablancaBoard::VARIANT) {
            $board = (new CapablancaFenStrToBoard($params['fen']))->create();
        } elseif ($params['variant'] === CapablancaFischerBoard::VARIANT) {
            $startPos = str_split($params['startPos']);
            $board = (new CapablancaFischerStrToBoard($params['fen'], $startPos))->create();
        } elseif ($params['variant'] === ClassicalBoard::VARIANT) {
            $board = (new ClassicalFenStrToBoard($params['fen']))->create();
        }

        $paragraph = (new FenExplanation($board))->getParagraph();

        return $this->json([
            'explanation' => implode(' ', $paragraph),
        ]);
    }
}
