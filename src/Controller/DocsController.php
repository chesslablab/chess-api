<?php

namespace ChessApi\Controller;

use ChessApi\Pdo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DocsController extends AbstractController
{
    const DOCS_FOLDER = __DIR__.'/../../docs';

    public function index(Request $request): Response
    {
        $json = file_get_contents(self::DOCS_FOLDER . '/swagger.json');

        $response = new Response();
        $response->setContent($json);

        return $response;
    }
}
