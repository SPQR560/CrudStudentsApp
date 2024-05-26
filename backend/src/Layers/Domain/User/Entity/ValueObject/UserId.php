<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class UserId
{
    private string $id;

    public function __construct(string $id)
    {
        if (!$id) {
            throw new InvalidArgumentException('id is empty');
        }

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }
}
