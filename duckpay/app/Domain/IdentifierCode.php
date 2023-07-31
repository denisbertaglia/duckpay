<?php

namespace App\Domain;

class IdentifierCode
{
    private $code;
    public function __construct($code)
    {
        $this->code = $code;
    }
    public function code(){
        return $this->code;
    }
}
