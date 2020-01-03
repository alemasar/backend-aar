<?php

namespace App\Domain\User\Data;

final class UserCreateData
{
    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $password;
    
    /** @var string */
    public $created_at;

    /** @var string */
    public $updated_at;

    /** @var int */
    public $role;
}