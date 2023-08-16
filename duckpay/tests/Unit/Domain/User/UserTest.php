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
        $id = new IdentifierCode('1');
        $userType = new UserType(UserType::TYPE['CUSTOMER']);
        $name = 'John';

        $idEmail1 = new IdentifierCode('2');
        $idEmail2 = new IdentifierCode('4');
        $email1 = 'john@teste.com';
        $email2 = 'john_test@teste.com';
        $emails = [
            0 => new Email($idEmail1,true,$email1),
            1 => new Email($idEmail2,false,$email2),
        ];

        $password = 'rtyuio123';
        $login = new User($id,$userType,$name,$emails);
        $login->setPassword($password);

        $loginReflection = new \ReflectionObject($login);
        $propertyPassword = $loginReflection->getProperty('password');
        $propertyPassword->setAccessible(true);
        $tee = $propertyPassword->getValue($login);
        $passwordData = $propertyPassword->getValue($login);

        $this->assertEquals($login->getId(),'1', "Set Id");
        $this->assertEquals($login->getName(),$name, "Set name");
        $this->assertEquals($login->getEmails(),$emails, "Set email");
        $this->assertEquals($passwordData, $password, "Set password");
        $this->assertEquals($password, $login->getPassword());
    }
}
