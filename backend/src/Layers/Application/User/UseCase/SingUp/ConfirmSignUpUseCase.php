<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Application\User\UseCase\SingUp;

use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\BadConfirmToken;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\ConfirmTokenIsExpiredException;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\UserAlreadyActiveException;
use Spqr560\StudentsRoot\Layers\Domain\User\Repository\UserRepositoryInterface;

/**
 * Registration confirm
 */
class ConfirmSignUpUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws UserAlreadyActiveException
     * @throws BadConfirmToken
     * @throws ConfirmTokenIsExpiredException
     */
    public function handle(string $email, string $token): void
    {
        $user = $this->userRepository->getByEmail(new UserEmail($email));

        if ($user->isRegistrationStatusActive()) {
            throw new UserAlreadyActiveException('User already active');
        }

        $user->setActiveStatus($token);

        $this->userRepository->add($user);
    }
}
