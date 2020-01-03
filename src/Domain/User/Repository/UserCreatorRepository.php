<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserCreatorRepository
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
     * Insert user row.
     *
     * @param UserCreateData $user The user
     *
     * @return int The new ID
     */
    public function insertUser(UserCreateData $user): int
    {
        $row = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'role_id' => $user->role
        ];
        $newId = $this->connection->table('users')->insertGetId($row);

        return $newId;
    }

    public function checkEmptyEmail($email)
    {
        $rows = $this->connection->table('users')->where('email', $email)->get()->isEmpty();
        return $rows;
    }
}
