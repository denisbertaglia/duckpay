<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

interface UserRepository
{
    public function add(User $user): User;
    public function findByIdCode(IdentifierCode $id): User | null;
    public function  findAll(): array;
}
