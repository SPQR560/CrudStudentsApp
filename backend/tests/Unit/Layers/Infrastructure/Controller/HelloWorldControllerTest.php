<?php

declare(strict_types=1);

namespace Spqr560\Tests\Unit\Layers\Infrastructure\Controller;

use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use Spqr560\StudentsRoot\Layers\Infrastructure\Controller\HelloWorldController;

class HelloWorldControllerTest extends TestCase
{
    public function testHandle(): void
    {
        // arange
        $action = new HelloWorldController();

        // act
        $response = $action->handle(new ServerRequest());

        // assert
        self::assertEquals(200, $response->getStatusCode());
        $content = $response->getBody()->getContents();
        self::assertEquals(
            ['message' => 'Hello World, good night and sleep well '],
            json_decode($content, true)
        );
    }
}
