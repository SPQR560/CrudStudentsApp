<?php

declare(strict_types=1);

namespace Spqr560\Tests\Unit\Layers\Domain\User\Service;

use PHPUnit\Framework\TestCase;
use Random\RandomException;
use Spqr560\StudentsRoot\Layers\Domain\User\Service\ConfirmTokenGenerator;

class ConfirmTokenGeneratorTest extends TestCase
{
    /**
     * @throws RandomException
     */
    public function testGenerate(): void
    {
        // Arrange
        $generator = new ConfirmTokenGenerator();

        // Act
        $token = $generator->generate();

        // Assert
        self::assertFalse($token->isExpired());
        $stringToken = $token->getToken();
        self::assertIsString($stringToken);
        $intToken = (int) $stringToken;
        self::assertTrue($intToken > 10000 && $intToken < 99999);
    }
}
