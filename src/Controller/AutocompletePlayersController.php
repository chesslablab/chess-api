<?php

namespace ChessApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AutocompletePlayersController extends AbstractController
{
    const DATA_FOLDER = __DIR__.'/../../data';

    const FILENAME = 'autocomplete-players.json';

    public function index(Request $request): Response
    {
        $contents = file_get_contents(self::DATA_FOLDER.'/'.self::FILENAME);

        $response = new Response();
        $response->setContent($contents);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
