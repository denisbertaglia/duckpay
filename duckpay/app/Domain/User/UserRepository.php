<?php

namespace App\Domain\User;

use App\Domain\IdentifierCode;

interface UserRepository
{
    public function add(User $user): User;
    public function findByIdCode(IdentifierCode $id): User | null;
    public function findFinancialEntityByIdCode(IdentifierCode $id): FinancialEntity | null;
    public function findAll(): array;
    public function findFilterAndPaginatedActiveUsers(UserType $userType, int $offset, int $limit): array;
    public function countFilterAndPaginatedActiveUsers(UserType $userType): int;
}
