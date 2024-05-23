<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route\Route;
use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__).'/vendor/autoload.php';

$app = AppFactory::create();

//(new Dotenv())->load(dirname(__DIR__) . '/.env');


$app->addErrorMiddleware((bool)getenv('BACKEND_DEBUG_MODE'), false, false);

// Add route callbacks
Route::initRoutes($app);

// Run application
$app->run();
