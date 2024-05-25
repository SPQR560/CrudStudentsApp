<?php

namespace Spqr560\Tests\Feature;

use DI\Container;
use PHPUnit\Framework\TestCase;
use Slim\App;
use Slim\Factory\AppFactory;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Middleware\Middleware;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route\Route;

class WebTestCase extends TestCase
{
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
