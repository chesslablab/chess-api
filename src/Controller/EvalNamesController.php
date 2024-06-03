<?php

namespace ChessApi\Controller;

use Chess\Function\StandardFunction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EvalNamesController extends AbstractController
{
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        $functions = [
            StandardFunction::NAME,
        ];

        if (!isset($params['function'])) {
            throw new BadRequestHttpException();
        } elseif (!in_array($params['function'], $functions)) {
            throw new BadRequestHttpException();
        }

        if (isset($params['exclude'])) {
            $exclude = explode(',', $params['exclude']);
        } else {
            $exclude = [];
        }

        $diff = array_diff((new StandardFunction())->names(), $exclude);

        return $this->json($diff);
    }
}
