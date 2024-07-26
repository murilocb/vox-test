<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CorsListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if (!$response) {
            return;
        }

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        $response->headers->set('Access-Control-Max-Age', '3600');

        if ($request->isMethod('OPTIONS')) {
            $response->setStatusCode(204);
            $response->sendHeaders();
            $event->stopPropagation();
        }
    }
}

