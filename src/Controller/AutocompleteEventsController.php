<?php

namespace ChessApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AutocompleteEventsController extends AbstractController
{
    const DATA_FOLDER = __DIR__.'/../../data/autocomplete';

    const AUTOCOMPLETE_EVENTS_FILE = 'events.json';

    public function index(Request $request): Response
    {
        $content = file_get_contents(self::DATA_FOLDER.'/'.self::AUTOCOMPLETE_EVENTS_FILE);

        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
