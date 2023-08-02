<?php

namespace App\Domain;

class IdentifierCode
{
    private string $code;
    public function __construct(string $code)
    {
        $this->code = $code;
    }
    public function code():string{
        return $this->code;
    }
}
