<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Domain\User\Repository;

use Spqr560\StudentsRoot\Layers\Domain\User\Entity\User;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;

interface UserRepositoryInterface
{
    public function add(User $user): void;
    public function hasByEmail(UserEmail $email): bool;
    public function getByEmail(UserEmail $email): User;
}