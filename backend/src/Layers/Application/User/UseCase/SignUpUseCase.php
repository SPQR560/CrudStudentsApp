<?php

declare(strict_types=1);

namespace Spqr560\StudentsRoot\Layers\Application\User\UseCase;


use Spqr560\StudentsRoot\Layers\Domain\FlusherInterface;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\User;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;
use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserId;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\UserAlreadyExists;
use Spqr560\StudentsRoot\Layers\Domain\User\Repository\UserRepositoryInterface;
use Spqr560\StudentsRoot\Layers\Domain\User\Service\ConfirmTokenGenerator;
use Spqr560\StudentsRoot\Layers\Domain\User\Service\PasswordEncryptor;

/**
 * Registration
 */
class SignUpUseCase
{
    private UserRepositoryInterface $userRepository;
    private PasswordEncryptor $passwordHasher;
    private ConfirmTokenGenerator $confirmTokenizer;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordEncryptor       $passwordHasher,
        ConfirmTokenGenerator   $confirmTokenizer,
    ) {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->confirmTokenizer = $confirmTokenizer;
    }

    /**
     * @throws UserAlreadyExists
     */
    public function handle(string $email, string $password): void
    {
        $email = new UserEmail($email);

        if ($this->userRepository->hasByEmail($email)) {
            throw new UserAlreadyExists('User already exists');
        }

        $hashedPassword = $this->passwordHasher->encrypt($password);

        $user = new User(
            UserId::generate(),
            $email,
            new \DateTimeImmutable(),
            $hashedPassword,
            $this->confirmTokenizer->generate()
        );

        $this->userRepository->add($user);
    }
}