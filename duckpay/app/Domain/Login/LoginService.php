<?php

namespace App\Domain\Login;

use App\Domain\Email;
use App\Domain\IdentifierCode;

interface LoginService
{
    public function loggingIn(IdentifierCode $idUser, Email $email, string $password) :bool;
}
