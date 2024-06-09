<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Doctrine\Type\User;


use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;



final class EmailType extends StringType
{
    public const string NAME = 'user_user_email';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof UserEmail ? $value->getEmail() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return !empty($value) ? new UserEmail($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
