<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject;

use DateTimeImmutable;

class ConfirmToken
{
    private string $token;
    private DateTimeImmutable $expiresAt;

    public function __construct(string $token, DateTimeImmutable $expiresAt)
    {
        $this->token = $token;
        $this->expiresAt = $expiresAt;
    }

    public function isExpired(DateTimeImmutable $dateTime = new DateTimeImmutable()): bool
    {
        return $this->expiresAt <= $dateTime;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function isEqualTo(string $token): bool
    {
        return $this->token === $token;
    }
}