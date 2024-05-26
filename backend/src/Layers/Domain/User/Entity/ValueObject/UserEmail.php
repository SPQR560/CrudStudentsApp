<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject;

use InvalidArgumentException;

class UserEmail
{
    private string $email;

    public function __construct(string $email)
    {
        if (!$email) {
            throw new InvalidArgumentException('email is empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException($email . ' is not correct email');
        }

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
