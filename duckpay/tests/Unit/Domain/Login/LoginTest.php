<?php

namespace Domain\Login;

use App\Domain\IdentifierCode;
use App\Domain\Login\Login;
use App\Domain\Login\UserType;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_login(): void
    {
        $id = new IdentifierCode('1');
        $userType = new UserType(UserType::TYPE['CUSTOMER']);
        $name = 'John';
        $email = 'teste@teste.com';
        $password = 'rtyuio123';
        $login = new Login($id,$userType,$name,$email,$password);

        $loginReflection = new \ReflectionObject($login);
        $propertyPassword = $loginReflection->getProperty('password');
        $propertyPassword->setAccessible(true);
        $tee = $propertyPassword->getValue($login);
        $passwordData = $propertyPassword->getValue($login);

        $this->assertEquals($login->id(),'1', "Set Id");
        $this->assertEquals($login->name(),$name, "Set name");
        $this->assertEquals($login->email(),$email, "Set email");
        $this->assertEquals($passwordData, $password, "Set password");
    }
}
