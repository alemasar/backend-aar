<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserAuthData;
use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Repository\UserAuthRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class UserAuth
{
    /**
     * @var UserAuthRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserAuthRepository $repository The repository
     */
    public function __construct(UserAuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param UserAuthData $user The user data
     *
     */
    public function checkLogin(UserAuthData $user)
    {
        // Validation
        if (empty($user->email) || empty($user->password)) {
            throw new UnexpectedValueException('Email and password required', 400);
        }

        $checkUser = $this->repository->getUser($user);
        $loginUser = new UserCreateData();
        $loginUser->name = $checkUser->name;
        $loginUser->email = $checkUser->email;
        $loginUser->password = $checkUser->password;
        $loginUser->created_at = $checkUser->created_at;
        $loginUser->updated_at = $checkUser->updated_at;

        $checkPassword = hash('gost', $user->password.$loginUser->name.$loginUser->created_at);
        if ($checkPassword !== $loginUser->password){
            throw new UnexpectedValueException('User or password not authorized', 401);
        }
        return true;
    }
}