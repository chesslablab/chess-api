<?php

namespace ChessApi\EventListener;

use Symfony\Component\HttpKernel\Event\TerminateEvent;
use Symfony\Component\Routing\RouterInterface;

class DownloadImageListener
{
    const OUTPUT_FOLDER = __DIR__.'/../../storage/tmp';

    /**
     * @var RouterInterface
     */
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onKernelTerminate(TerminateEvent $event)
    {
        $currentRoute = $this->router->match($event->getRequest()->getPathInfo());
        if ('api_download_image' === $currentRoute['_route']) {
            $filename = $event->getRequest()->attributes->get('filename');
            unlink(self::OUTPUT_FOLDER . '/'. $filename);
        }
    }
}
