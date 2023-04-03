<?php

namespace ChessApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchAutocompleteController extends AbstractController
{
    const DATA_FOLDER = __DIR__.'/../../data';

    const AUTOCOMPLETE_EVENTS = 'autocomplete-events.json';

    const AUTOCOMPLETE_PLAYERS = 'autocomplete-players.json';

    public function index(Request $request): Response
    {
        $events = file_get_contents(self::DATA_FOLDER.'/'.self::AUTOCOMPLETE_EVENTS);
        $players = file_get_contents(self::DATA_FOLDER.'/'.self::AUTOCOMPLETE_PLAYERS);

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
