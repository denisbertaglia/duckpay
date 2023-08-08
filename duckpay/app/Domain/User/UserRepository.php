<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

interface UserRepository
{
    public function add(User $user): void;
    public function findByIdCode(IdentifierCode $id): User;
    public function  findAll(): array;
}
