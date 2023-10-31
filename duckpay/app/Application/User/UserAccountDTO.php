<?php

namespace App\Application\User;

class UserAccountDTO
{
    public int $id = 0;
    public string $account;
    public string $userType;
    public string $name;
    public string $taxpayer;
    public array $emails = [];
}
