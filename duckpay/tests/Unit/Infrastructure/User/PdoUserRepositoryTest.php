<?php
namespace Tests\Unit\Infrastructure\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use App\Domain\User\UserType;
use App\Infrastructure\User\PdoUserRepository;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Infrastructure\TestDB;

class PdoUserRepositoryTest extends TestCase
{
    use TestDB;

    private UserRepository $pdoUserRepository;
    private array $dataSetList = [
        'test_find_users'
    ];
    protected function setUp(): void
    {
        parent::setUp();
        $this->pdoUserRepository= new PdoUserRepository($this->getConnection());
    }

    public function test_add_user(): void
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


        $this->pdoUserRepository->add($login);
        $users = $this->pdoUserRepository->findAll();
        $this->assertCount(1,$users);

    }
    public function test_find_all_users(): void
    {
        $this->setDataSet('test_find_users');
        $users = $this->pdoUserRepository->findAll();

        $this->assertIsArray($users);
        $this->assertCount(4, $users);
    }
    public function test_find_one_user(): void
    {
        $this->setDataSet('test_find_users');

        $user = $this->pdoUserRepository->findByIdCode(new IdentifierCode('2'));

        $this->assertIsObject($user);
        $this->assertEquals("Thiago Anton", $user->getName());

    }
}
