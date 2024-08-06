<?php

namespace ChessApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AnnotationsGamesController extends AbstractController
{
    const DATA_FOLDER = __DIR__.'/../../data/annotations';

    const ANNOTATIONS_GAMES_FILE = 'games.json';

    public function index(Request $request): Response
    {
        $games = file_get_contents(self::DATA_FOLDER.'/'.self::ANNOTATIONS_GAMES_FILE);

        $content = json_encode([
            'games' => json_decode($games),
        ]);

        return new Response($content, 200, ['content-type' => 'application/json']);
    }
}
