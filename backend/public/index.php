<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route\Route;

require_once dirname(__DIR__).'/vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false);

// Add route callbacks
Route::initRoutes($app);

// Run application
$app->run();
