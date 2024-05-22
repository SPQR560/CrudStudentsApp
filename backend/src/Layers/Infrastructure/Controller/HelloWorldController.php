<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Controller;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;

class HelloWorldController implements RequestHandlerInterface
{
    public function handle(Request $request): Response
    {
        return new JsonResponse([
            'message' => 'Hello World, good night and sleep well ',
        ]);
    }
}
