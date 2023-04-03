<?php

namespace ChessApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StatsOpeningController extends AbstractController
{
    const DATA_FOLDER = __DIR__.'/../../data/stats/opening';

    const DRAW_RATE_FILE = 'draw-rate.json';

    const WIN_RATE_FOR_WHITE_FILE = 'win-rate-for-white.json';

    const WIN_RATE_FOR_BLACK_FILE = 'win-rate-for-black.json';

    public function index(Request $request): Response
    {
        $drawRate = file_get_contents(self::DATA_FOLDER.'/'.self::DRAW_RATE_FILE);
        $winRateForWhite = file_get_contents(self::DATA_FOLDER.'/'.self::WIN_RATE_FOR_WHITE_FILE);
        $winRateForBlack = file_get_contents(self::DATA_FOLDER.'/'.self::WIN_RATE_FOR_BLACK_FILE);

        $content = json_encode([
            'drawRate' => json_decode($drawRate),
            'winRateForWhite' => json_decode($winRateForWhite),
            'winRateForBlack' => json_decode($winRateForBlack)
        ]);

        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
