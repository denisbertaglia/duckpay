<?php
namespace Tests\Unit\Infrastructure\User;

use App\Domain\Email;
use App\Domain\IdentifierCode;
use App\Domain\User\Customer;
use App\Domain\User\Shopkeeper;
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
        $id = '1';
        $userType = UserType::TYPE['CUSTOMER'];
        $name = 'John';
        $emails = [
            0 => Email::make('1','johns@teste.com',true),
            1 => Email::make('2','john_test2@teste.com',false),
        ];

        $password = 'rtyuio123';
        $login = User::makeUser($id,$userType,$name,$emails);
        $login->setPassword($password);

        $this->pdoUserRepository->add($login);
        $users = $this->pdoUserRepository->findAll();
        $this->assertCount(1,$users);
        /** @var User $user */
        $user = array_shift($users);
        $emailsDB = $user->getEmails();
        $this->assertCount(2,$emailsDB);
        $this->assertEquals($emails[0]->email(),$emailsDB[0]->email());
        $this->assertEquals($emails[1]->email(),$emailsDB[1]->email());

    }
    public function test_find_all_users(): void
    {
        $this->setDataSet('test_find_users');
        $users = $this->pdoUserRepository->findAll();

        $this->assertIsArray($users);
        $this->assertCount(3, $users);
        $usersType = array_map(function ( User $user){
            return $user->getType();
        }, $users);
        $this->assertContains('SHOPKEEPER', $usersType);
        $this->assertContains('CUSTOMER', $usersType);
        $this->assertContains('LOGIN', $usersType);

    }
    public function test_find_one_user(): void
    {
        $this->setDataSet('test_find_users');

        $user = $this->pdoUserRepository->findByIdCode(new IdentifierCode('2'));

        $this->assertIsObject($user);
        $this->assertEquals("Thiago Anton", $user->getName());

    }
    public function  test_add_user_customer(): void {
        $name = 'John Martins';
        $cpf = '999.999.999-00';
        $balance = '1122';
        $emails = [
            0 => Email::make('1','johns@teste.com',true),
            1 => Email::make('2','john_test2@teste.com',false),
        ];

        $password = 'rtyuio3-d}123';
        $login = Customer::makeCustomer('1',$name,$cpf,$emails,$balance);
        $login->setPassword($password);
        $user = $this->pdoUserRepository->add($login);
        $this->assertNotEmpty($user->getId());
    }
    public function  test_add_user_shopkeeper(): void {
        $name = 'Magazine Acre do Sul';
        $cnpj = '95.454.908/0001-81';
        $balance = '345';

        $emails = [
            0 => Email::make('3','maken@teste.com',true),
            1 => Email::make('4','maken_test@teste.com',false),
        ];

        $login = Shopkeeper::makeShopkeeper('3',$name,$cnpj,$emails,$balance);
        $password = 'rtyuio3-d}123';

        $login->setPassword($password);
        $user = $this->pdoUserRepository->add($login);
        $this->assertNotEmpty($user->getId());

    }
}
