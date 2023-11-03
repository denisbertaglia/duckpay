<?php

namespace Tests\Feature\Application\User;

use App\Application\User\UserAccountDTO;
use App\Application\User\UserSevice;
use App\Domain\User\UserRepository;
use App\Infrastructure\User\PdoUserRepository;
use PHPUnit\Framework\TestCase;
use Tests\Feature\Infrastructure\TestDB;


class UserServiceTest extends TestCase
{
    use TestDB;

    private UserRepository $userRepository;
    private UserSevice $userSevice;
    private  $conn;
    protected function setUp(): void
    {
        parent::setUp();
        $this->conn = $this->getConnection();
        $this->userRepository= new PdoUserRepository($this->conn);
        $this->userSevice = new UserSevice($this->userRepository);
    }

    public function test_find_user_paginated(): void
    {
        $this->setDataSet('test_find_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->listUsersFilterByTypeWithPagination();

        $this->assertCount(2,$users);
    }
    public function test_find_user_second_page():void{
        $this->setDataSet('test_find_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->listUsersFilterByTypeWithPagination(2);

        $this->assertCount(0,$users);
    }

    /**
     * @param int $page number
     * @param int $pageSize number
     * @param int $userQuant
     * @dataProvider data_set_paginated_users   
     * @return void
     */
    public function test_find_user_page(int $page,int  $pageSize,int $userQuant): void{
        $this->setDataSet('test_paginated_users');
        $userSevice = $this->userSevice;
        $users = $userSevice->listUsersFilterByTypeWithPagination($page, $pageSize);
        $this->assertCount($userQuant,$users);
    }
    public static function data_set_paginated_users(): array{
        return [
            [1,10,10],
            [1,20,20],
            [2,20,20],
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
        ];
    }

}
