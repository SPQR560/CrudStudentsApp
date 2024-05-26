<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Application\User\UseCase\SingUp;

use Random\RandomException;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\User;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserId;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\UserAlreadyExists;
use Spqr560\StudentsRoot\Layers\Domain\User\Repository\UserRepositoryInterface;
use Spqr560\StudentsRoot\Layers\Domain\User\Service\ConfirmTokenGenerator;
use Spqr560\StudentsRoot\Layers\Domain\User\Service\PasswordEncryptor;

/**
 * Registration.
 */
class SignUpUseCase
{
    private UserRepositoryInterface $userRepository;
    private PasswordEncryptor $passwordEncryptor;
    private ConfirmTokenGenerator $confirmTokenGenerator;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordEncryptor $passwordEncryptor,
        ConfirmTokenGenerator $confirmTokenGenerator,
    ) {
        $this->userRepository = $userRepository;
        $this->passwordEncryptor = $passwordEncryptor;
        $this->confirmTokenGenerator = $confirmTokenGenerator;
    }

    /**
     * @throws UserAlreadyExists
     * @throws RandomException
     */
    public function handle(string $email, string $password): void
    {
        $email = new UserEmail($email);

        if ($this->userRepository->hasByEmail($email)) {
            throw new UserAlreadyExists('User already exists');
        }

        $hashedPassword = $this->passwordEncryptor->encrypt($password);

        $user = new User(
            UserId::generate(),
            $email,
            new \DateTimeImmutable(),
            $hashedPassword,
            $this->confirmTokenGenerator->generate()
        );

        $this->userRepository->add($user);
    }
}
