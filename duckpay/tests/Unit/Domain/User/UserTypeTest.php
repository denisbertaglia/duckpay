<?php

namespace Tests\Unit\Domain\User;

use App\Domain\User\UserType;
use PHPUnit\Framework\TestCase;

class UserTypeTest extends TestCase
{
    /**
     *
     * @param string $userName
     * @param int $userCode
     * @dataProvider data_set_user_type
     * @return void
     */
    public function test_create_user_type(string $userName, int $userCode): void
    {
        $userType = new UserType($userCode);
        $this->assertEquals($userName, $userType->getName());
    }
    /**

     * @param string $userName
     * @param int $userCode
     * @dataProvider data_set_user_type
     * @return void
     */
    public function test_make_user_type(string $userName, int $userCode): void
    {
        $userType = UserType::make($userName);
        $this->assertEquals($userName, $userType->getName());
        $this->assertEquals($userCode, $userType->getCode());
    }

    public static function data_set_user_type()
    {
        return [
            "Login default" =>
            [
                'LOGIN',
                0
            ],
            "Customer" =>
            [
                'CUSTOMER',
                1
            ],
            "Shopkeepers" =>
            [
                'SHOPKEEPER',
                2
            ],
        ];
    }
}
