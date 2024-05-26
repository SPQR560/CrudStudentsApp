<?php

namespace Spqr560\Tests\Unit\Layers\Domain\User\Service;

use PHPUnit\Framework\TestCase;
use Spqr560\StudentsRoot\Layers\Domain\User\Service\PasswordEncryptor;

class PasswordEncryptorTest extends TestCase
{
    public function testEncrypt(): void
    {
        // Arrange
        $password = 'qwerty2000';
        $encryptor = new PasswordEncryptor();

        // Act
        $encryptedPassword  = $encryptor->encrypt($password);

        // Assert
        self::assertTrue($encryptor->isPasswordValid($encryptedPassword, $password));
    }
}