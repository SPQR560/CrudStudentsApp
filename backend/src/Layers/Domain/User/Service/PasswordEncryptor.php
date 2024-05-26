<?php

namespace Spqr560\StudentsRoot\Layers\Domain\User\Service;

namespace Spqr560\StudentsRoot\Layers\Domain\User\Service;

class PasswordEncryptor
{
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function isPasswordValid(string $encryptedPassword, string $password): bool
    {
        return password_verify($password, $encryptedPassword);
    }
}
