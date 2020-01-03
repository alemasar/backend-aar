<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserRolesData;
use App\Domain\User\Repository\UserRolesRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class ListUserRoles
{
    /**
     * @var UserRolesRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserRolesRepository $repository The repository
     */
    public function __construct(UserRolesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of roles.
     */
    public function getRoles()
    {
        $roles = $this->repository->getRoles();
        return $roles;
    }
}