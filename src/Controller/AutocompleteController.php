<?php

namespace ChessApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AutocompleteController extends AbstractController
{
    const DATA_FOLDER = __DIR__.'/../../data/autocomplete';

    const AUTOCOMPLETE_EVENTS_FILE = 'events.json';

    const AUTOCOMPLETE_PLAYERS_FILE = 'players.json';

    public function index(Request $request): Response
    {
        $events = file_get_contents(self::DATA_FOLDER.'/'.self::AUTOCOMPLETE_EVENTS_FILE);
        $players = file_get_contents(self::DATA_FOLDER.'/'.self::AUTOCOMPLETE_PLAYERS_FILE);

        $content = json_encode([
            'events' => json_decode($events),
            'players' => json_decode($players),
        ]);

        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
