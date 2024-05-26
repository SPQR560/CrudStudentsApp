<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Domain\User\Service;

use DateTimeImmutable;
use Random\RandomException;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\ConfirmToken;

final class ConfirmTokenGenerator
{
    private const int LIVE_MINUTES = 10;

    /**
     * @throws RandomException
     */
    public function generate(): ConfirmToken
    {
        $liveMinutes = self::LIVE_MINUTES;
        $expiresAt = (new DateTimeImmutable())->modify("+{$liveMinutes} minutes");

        $token  = (string) random_int(10000, 99999);

        return new ConfirmToken($token, $expiresAt);
    }
}
