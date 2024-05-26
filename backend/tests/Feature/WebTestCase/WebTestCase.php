<?php

namespace Spqr560\Tests\Feature\WebTestCase;

use DI\Container;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Uri;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Middleware\Middleware;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route\Route;

class WebTestCase extends TestCase
{
    protected function method(string $uri, RequestMethodEnum $method): ResponseInterface
    {
        return $this->request(
            (new ServerRequest())
                ->withUri(new Uri('http://test'.$uri))
                ->withMethod($method->name)
        );
    }

    protected function request(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->createApp()->handle($request);
        $response->getBody()->rewind();

        return $response;
    }

    private function createApp(): App
    {
        $container = new Container();
        AppFactory::setContainer($container);

        $app = AppFactory::create();
        Middleware::init($app);
        Route::initRoutes($app);

        return $app;
    }
}
