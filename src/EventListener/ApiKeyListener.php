<?php

namespace ChessApi\EventListener;

use Dotenv\Dotenv;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\RouterInterface;

class ApiKeyListener
{
    /**
     * @var RouterInterface
     */
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../../');
        $dotenv->load();
    }

    public function onKernelRequest(RequestEvent $event)
    {
        if ('OPTIONS' === $event->getRequest()->getMethod()) {
            exit;
        }

        $apiKey = $event->getRequest()->headers->get('X-Api-Key');
        if (!password_verify($_ENV['API_KEY_PASSWORD'], stripslashes($apiKey))) {
            throw new AccessDeniedHttpException();
        }
    }
}
