<?php

namespace App\Domain\Login;


use App\Domain\IdentifierCode;

class Token
{
    private IdentifierCode $id;
    private string $token;
    public function __construct(IdentifierCode $id, string $token)
    {
        $this->id = $id;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function token(): string
    {
        return $this->token;
    }
}
