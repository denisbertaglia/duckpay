<?php

namespace App\Infrastructure\User;

use App\Domain\IdentifierCode;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use Pdo;

class PdoUserRepository implements UserRepository
{
    public function __construct(Pdo $db)
    {

    }
    public function add(User $user): void
    {
        // TODO: Implement add() method.
    }

    public function findByIdCode(IdentifierCode $id): User
    {
        // TODO: Implement findByIdCode() method.
    }

    public function findAll(): array
    {
        return  [];
    }
}
