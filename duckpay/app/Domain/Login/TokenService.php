<?php

namespace App\Domain\Login;

use App\Domain\IdentifierCode;

interface TokenService
{
    public function makeToken(IdentifierCode $idLogin): Token;
}
