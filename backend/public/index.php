<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route\Route;
use Symfony\Component\Dotenv\Dotenv;

$projectPath = dirname(__DIR__);
require_once $projectPath . '/vendor/autoload.php';

$app = AppFactory::create();

if (file_exists($projectPath . '/.env')) {
    (new Dotenv())->usePutenv()->load($projectPath . '/.env');
} else {
    throw new RuntimeException('dot env file is not found');
}

$app->addErrorMiddleware((bool)getenv('BACKEND_DEBUG_MODE'), false, false);

// Add route callbacks
Route::initRoutes($app);

// Run application
$app->run();
