<?php

namespace ChessApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AnnotationsGames extends AbstractController
{
  const DATA_FOLDER = __DIR__.'/../../ data/annotations/';

  const ANNOTATIONS_GAMES_FILE = 'games.json';

  public function index(Request $request): Response
    {
        $games = file_get_contents(self::DATA_FOLDER.'/'.self::ANNOTATIONS_GAMES_FILE);

        $content = json_encode([
            'games' => json_decode($games),
        ]);

        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
  
}
