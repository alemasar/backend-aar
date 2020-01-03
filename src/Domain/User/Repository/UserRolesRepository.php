<?php

namespace App\Domain\User\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserRolesRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * The constructor.
     *
     * @param Connection $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get user roles.
     *
     * @return collection User roles
     */
    public function getRoles()
    {
        return $this->connection->table('roles')->get();
    }
}