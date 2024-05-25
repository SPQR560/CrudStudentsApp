<?php

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Middleware;

use Slim\App;

class Middleware
{
    public static function init(App &$app): void
    {
        $app->addErrorMiddleware((bool) getenv('BACKEND_DEBUG_MODE'), false, false);
    }
}
