<?php

namespace App\Domain\Login;

class UserType
{
    const TYPE = [
        "LOGIN" => 0,
        "CUSTOMER" => 1,
        "SHOPKEEPER" => 2,
    ];
    private int $type = 0;

    /**
     * @param int $type UserType::TYPE["LOGIN"] - ["LOGIN", "CUSTOMER", "SHOPKEEPER"]
     */
    public function __construct(int $type = 0)
    {
        if(in_array($type,SELF::TYPE)){
            $this->type = $type;
        }
    }
    /**
     * @return string
     */
    public function type()
    {
        return array_search($this->type, SELF::TYPE);
    }
}
