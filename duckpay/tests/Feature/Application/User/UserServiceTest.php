<?php

namespace Tests\Feature\Application\User;

use App\Application\User\UserAccountDTO;
use App\Application\User\UserDTO;
use App\Application\User\UserSevice;
use App\Domain\User\UserRepository;

use App\Infrastructure\User\PdoUserRepository;
use PDO;
use PHPUnit\Framework\TestCase;
use Tests\Feature\Infrastructure\TestDB;


class UserServiceTest extends TestCase
{
    use TestDB;

    private UserRepository $userRepository;
    private UserSevice $userSevice;
    private  PDO $conn;
    protected function setUp(): void
    {
        parent::setUp();
        $this->conn = $this->getPdoConnection();
        $this->userRepository = new PdoUserRepository($this->conn);
        $this->userSevice = new UserSevice($this->userRepository);
    }

    public function test_find_user_paginated(): void
    {
        $this->setDataSet('test_find_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->listUsersFilterByTypeWithPagination();

        $this->assertCount(2, $users);
    }
    public function test_find_user_second_page(): void
    {
        $this->setDataSet('test_find_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->listUsersFilterByTypeWithPagination(2);

        $this->assertCount(0, $users);
    }

    /**
     * @param int $page number
     * @param int $pageSize number
     * @param int $userQuant
     * @dataProvider data_set_paginated_users
     * @return void
     */
    public function test_find_user_page(int $page, int  $pageSize, int $userQuant): void
    {
        $this->setDataSet('test_paginated_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->listUsersFilterByTypeWithPagination($page, $pageSize);
        $this->assertCount($userQuant, $users);
    }
    public static function data_set_paginated_users(): array
    {
        return [
            [1, 10, 10],
            [1, 20, 20],
            [2, 20, 20],
        ];
    }

    /**
     * @param int $page number
     * @param int $pageSize number
     * @param int $userQuant
     * @param string $userType
     * @dataProvider data_set_paginated_users_with_type
     * @return void
     */
    public function test_find_user_page_with_type(int $page, int  $pageSize, int $userQuant, string $userType): void
    {
        $this->setDataSet('test_paginated_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->listUsersFilterByTypeWithPagination($page, $pageSize, $userType);

        $this->assertCount($userQuant, $users, 'Count of users');
        $this->assertContainsOnlyInstancesOf(UserDTO::class, $users);

        if ($userType !== 'LOGIN') {
            $userFilted = array_filter($users, function (UserDTO $u) use ($userType,) {
                return $u->userType == $userType;
            });
            $this->assertCount($userQuant, $userFilted, 'Check types');
        }
    }

    public static function data_set_paginated_users_with_type(): array
    {
        return [
            "CUSTOMER" => [1, 40, 37, 'CUSTOMER'],
            "LOGIN page 1" => [1, 20, 20, 'LOGIN'],
            "LOGIN page 2" => [2, 20, 20, 'LOGIN'],
            "SHOPKEEPER" => [1, 100, 33, 'SHOPKEEPER'],
        ];
    }
    /**
     * @param int $userQuant
     * @param string $userType
     * @dataProvider data_set_count_paginated_users_with_type
     * @return void
     */
    public function test_count_user_page_with_type( int $userQuant, string $userType): void
    {
        $this->setDataSet('test_paginated_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->countUsersFilterByTypeForPagination($userType);

        $this->assertEquals($userQuant, $users, 'Count of users');

    }

    public static function data_set_count_paginated_users_with_type(): array
    {
        return [
            "CUSTOMER" => [ 37, 'CUSTOMER'],
            "LOGIN" => [70, 'LOGIN'],
            "SHOPKEEPER" => [33, 'SHOPKEEPER'],
        ];
    }


    /**
     * @dataProvider data_set_list_user_data
     * @param int $id
     * @param string $name
     * @param string $userType
     * @param string $taxpayer
     * @param string $account
     * @param array $emails
     * @return void
     */
    public function test_list_user_data( int $id, string $name, string $userType, string $taxpayer, string $account, array $emails) {
        $this->setDataSet('test_find_users');
        $userService = $this->userSevice;
        $user = $userService->listUserData($id);
        $this->assertInstanceOf(UserAccountDTO::class,$user);
        $this->assertEquals($name,$user->name);
        $this->assertEquals($userType, $user->userType);
        $this->assertEquals($taxpayer,$user->taxpayer);
        $this->assertEquals($account,$user->account);
        $this->assertEquals($emails,$user->emails);

    }
    public static function data_set_list_user_data(): array{
        return [
            [1,'Joâo Henrique', 'LOGIN', '', '0.00', []],
            [2,'Thiago Anton', 'CUSTOMER', '434.234.778-98', '494.44', []],
            [3,'Marcia Ribeiro', 'SHOPKEEPER', '95.454.908/0001-81', '494.44', []],
        ];
    }
}
