<?php

namespace App\Domain\Login;

use App\Domain\IdentifierCode;

interface LoginService
{
    public function validLogin(IdentifierCode $idUser, string $password) :bool;
}
