<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Repository\UserCreatorRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class UserCreator
{
    /**
     * @var UserCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserCreatorRepository $repository The repository
     */
    public function __construct(UserCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param UserCreateData $user The user data
     *
     * @return int The new user ID
     */
    public function createUser(UserCreateData $user): int
    {
        // Validation
        if (empty($user->email)) {
            throw new UnexpectedValueException('Email required', 400);
        }

        $repeated_email = $this->repository->getEmail($user->email);
        if (empty($repeated_email)===false){
            throw new UnexpectedValueException('Repeated Email', 400);
        }

        // Insert user
        $userId = $this->repository->insertUser($user);

        // Logging here: User created successfully

        return $userId;
    }
}