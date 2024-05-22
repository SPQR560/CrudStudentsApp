<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Route;

use Slim\App;

final class Route
{
    public static function initRoutes(App &$app): void
    {
        $app->get('/', \Spqr560\StudentsRoot\Layers\Infrastructure\Controller\HelloWorldController::class);
    }
}
