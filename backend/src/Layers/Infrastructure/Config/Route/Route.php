<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route;

use Slim\App;
use Spqr560\StudentsRoot\Layers\Infrastructure\Controller\HelloWorldController;

final class Route
{
    public static function initRoutes(App &$app): void
    {
        $app->get('/', HelloWorldController::class);
    }
}
