<?php

namespace ChessApi\Controller;

use Chess\FenToBoardFactory;
use Chess\Tutor\FenEvaluation;
use Chess\Variant\Classical\Board;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TutorFenController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        if (!isset($params['fen'])) {
            throw new BadRequestHttpException();
        }

        $board = FenToBoardFactory::create($params['fen'], new Board());

        $paragraph = (new FenEvaluation($board))->getParagraph();

        return $this->json(implode(' ', $paragraph));
    }
}
