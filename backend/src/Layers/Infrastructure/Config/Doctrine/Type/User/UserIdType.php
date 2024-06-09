<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Infrastructure\Config\Doctrine\Type\User;

use Doctrine\DBAL\Types\GuidType;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class UserIdType extends GuidType
{
    public const NAME = 'user_user_id';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof UserId ? $value->getId() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return !empty($value) ? new UserId($value) : null;
    }

    public function getName(): string {
        return self::NAME;
    }
}