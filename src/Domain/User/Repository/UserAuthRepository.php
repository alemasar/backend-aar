<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserAuthData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserAuthRepository
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
     * Get user data.
     *
     * @param UserAuthData $user The user
     *
     * @return collection User data
     */
    public function getUser(UserAuthData $user)
    {
        return $this->connection->table('users')->where('email', $user->email)->first();
    }
}
