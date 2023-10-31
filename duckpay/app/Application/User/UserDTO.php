<?php

namespace App\Application\User;

class UserDTO
{
    public string $id;
    public string $userType;
    public string $name;

    public array $emails = [];

    public function __construct($id,$userType, $name, $emails)
    {
        $this->id = $id;
        $this->userType = $userType;
        $this->name = $name;
        $this->emails = $emails;
    }
}
