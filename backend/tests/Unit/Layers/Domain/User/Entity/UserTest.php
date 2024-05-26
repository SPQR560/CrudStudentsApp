<?php

declare(strict_types=1);

namespace Spqr560\Tests\Unit\Layers\Domain\User\Entity;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\Enum\UserRegistrationStatusEnum;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\User;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\ConfirmToken;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserId;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\BadConfirmToken;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\ConfirmTokenIsExpiredException;

class UserTest extends TestCase
{
    public function testUserCreate(): void
    {
        //arrange
        $id = UserId::generate();
        $date = new DateTimeImmutable();
        $token = new ConfirmToken('token', new DateTimeImmutable('+1 day'));
        $email = new UserEmail('examplemail@test.com');
        $password = 'hashedPassword';

        //act
        $user = new User(
            $id,
            $email,
            $date,
            $password,
            $token,
        );

        //assert
        self::assertTrue($user->isRegistrationStatusWaiting());
        self::assertFalse($user->isRegistrationStatusActive());
    }

    /**
     * @throws ConfirmTokenIsExpiredException
     * @throws BadConfirmToken
     */
    public function testUserConfirm(): void
    {
        //arrange
        $id = UserId::generate();
        $date = new DateTimeImmutable();
        $email = new UserEmail('examplemail@test.com');
        $password = 'hashedPassword';
        $token = new ConfirmToken('token', new DateTimeImmutable('+5 minutes'));
        $user = new User(
            $id,
            $email,
            $date,
            $password,
            $token,
        );

        //act
        $user->setActiveStatus($token->getToken());

        //assert
        self::assertTrue($user->isRegistrationStatusActive());
    }
}