<?php

declare(strict_types=1);

namespace Spqr560\Tests\Feature\HelloWorldController;

use Spqr560\Tests\Feature\WebTestCase\RequestMethodEnum;
use Spqr560\Tests\Feature\WebTestCase\WebTestCase;

class HelloWorldWebTest extends WebTestCase
{
    public function testHelloWorld(): void
    {
        $response = $this->method('/', RequestMethodEnum::GET);

        self::assertEquals(200, $response->getStatusCode());
        $content = $response->getBody()->getContents();
        self::assertEquals(
            ['message' => 'Hello World, good night and sleep well '],
            json_decode($content, true)
        );
    }

}