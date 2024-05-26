<?php

namespace Spqr560\StudentsRoot\Layers\Application\User\UseCase;

use Spqr560\StudentsRoot\Layers\Domain\User\Entity\ValueObject\UserEmail;
use Spqr560\StudentsRoot\Layers\Domain\User\Exception\UserIsNotExist;
use Spqr560\StudentsRoot\Layers\Domain\User\Repository\UserRepositoryInterface;
use Spqr560\StudentsRoot\Layers\Domain\User\Service\PasswordEncryptor;

class SingInUseCase
{
    private UserRepositoryInterface $userRepository;
    private PasswordEncryptor $passwordEncryptor;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordEncryptor $passwordEncryptor
    ) {
        $this->userRepository = $userRepository;
        $this->passwordEncryptor = $passwordEncryptor;
    }

    /**
     * @throws UserIsNotExist
     */
    public function handle(string $email, string $password): void
    {
        $encryptedPassword = $this->passwordEncryptor->encrypt($password);

        if ($user = $this->userRepository->findByEmailAndPassword(new UserEmail($email), $encryptedPassword)) {
            throw new UserIsNotExist('user is not exist');
        }
    }
}
