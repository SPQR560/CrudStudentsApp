<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Domain\User\Entity;

use DateTimeImmutable;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\Enum\UserRegistrationStatusEnum;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\ConfirmToken;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserId;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\BadConfirmToken;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\ConfirmTokenIsExpiredException;

class User
{
    private UserId $id;
    private UserEmail $email;
    private DateTimeImmutable $lastModifiedDate;
    private string $encryptedPassword;
    private ConfirmToken $confirmToken;
    private UserRegistrationStatusEnum $registrationStatus;

    public function __construct(
        UserId            $id,
        UserEmail         $email,
        DateTimeImmutable $lastModifiedDate,
        string            $encryptedPassword,
        ConfirmToken      $confirmToken
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->lastModifiedDate = $lastModifiedDate;
        $this->encryptedPassword = $encryptedPassword;
        $this->confirmToken = $confirmToken;
        $this->registrationStatus = UserRegistrationStatusEnum::WAITING;
    }

    public function isRegistrationStatusWaiting(): bool
    {
        return $this->registrationStatus === UserRegistrationStatusEnum::WAITING;
    }

    public function isRegistrationStatusActive(): bool
    {
        return $this->registrationStatus === UserRegistrationStatusEnum::ACTIVE;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getLastModifiedDate(): DateTimeImmutable
    {
        return $this->lastModifiedDate;
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    public function getEncryptedPassword(): string
    {
        return $this->encryptedPassword;
    }

    public function getConfirmToken(): ConfirmToken
    {
        return $this->confirmToken;
    }

    /**
     * @throws ConfirmTokenIsExpiredException
     * @throws BadConfirmToken
     */
    public function setActiveStatus(string $token): void
    {
        $this->checkConformationToken($token);
        $this->registrationStatus = UserRegistrationStatusEnum::ACTIVE;
    }

    /**
     * @throws ConfirmTokenIsExpiredException
     * @throws BadConfirmToken
     */
    private function checkConformationToken(string $token): void
    {
        if (!$this->confirmToken->isEqualTo($token)) {
            throw new BadConfirmToken('Bad confirm token');
        }

        if ($this->confirmToken->isExpired()) {
            throw new ConfirmTokenIsExpiredException('token expired');
        }
    }
}
