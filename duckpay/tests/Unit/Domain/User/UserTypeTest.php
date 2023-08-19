<?php

namespace Domain\User;

use App\Domain\User\UserType;
use PHPUnit\Framework\TestCase;

class UserTypeTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_user_type(): void
    {
        $userType = new UserType(UserType::TYPE['LOGIN'],);
        $this->assertEquals('LOGIN',$userType->getFullType(), "Type default is LOGIN");
    }
}
