<?php

namespace Domain\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\User\User;
use App\Domain\User\UserType;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_login(): void
    {
        $id = '3';
        $userType = UserType::TYPE['CUSTOMER'];
        $name = 'John';

        $emails = [
            0 => Email::make('2','johns@teste.com',true),
            1 => Email::make('4','john_test@teste.com',false),
        ];

        $password = 'rtyuio123';
        $login = User::makeUser($id,$userType,$name,$emails);
        $login->setPassword($password);

        $loginReflection = new \ReflectionObject($login);
        $propertyPassword = $loginReflection->getProperty('password');
        $propertyPassword->setAccessible(true);
        $tee = $propertyPassword->getValue($login);
        $passwordData = $propertyPassword->getValue($login);

        $this->assertEquals($login->getId(),$id, "Set Id");
        $this->assertEquals($login->getName(),$name, "Set name");
        $this->assertEquals($login->getEmails(),$emails, "Set email");
        $this->assertEquals($passwordData, $password, "Set password");
        $this->assertEquals($password, $login->getPassword());
    }
}
