<?php

declare(strict_types=1);

use DI\Container;
use Slim\Factory\AppFactory;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Container\ContainerConfig;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Middleware\Middleware;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route\Route;
use Symfony\Component\Dotenv\Dotenv;

$projectPath = dirname(__DIR__);
require_once $projectPath.'/vendor/autoload.php';

if (file_exists($projectPath.'/.env')) {
    (new Dotenv())->usePutenv()->load($projectPath.'/.env');
} else {
    throw new RuntimeException('dot env file is not found');
}

$applicationClosure = function () {
    $container = new Container();
    ContainerConfig::init($container);

    AppFactory::setContainer($container);
    $app = AppFactory::create();

    // init middlewares
    Middleware::init($app);

    // Add route callbacks
    Route::init($app);

    // Run application
    $app->run();
};
$applicationClosure();
