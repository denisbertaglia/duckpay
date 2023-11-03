<?php

namespace App\Application\User;

use App\Application\Pagination;
use App\Domain\IdentifierCode;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use App\Domain\User\UserType;
use App\Models\Email;

class UserSevice
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @param array $filter
     * @return array
     */
    public function listUsersFilterByTypeWithPagination(int $page=1, int $pageSize=10, string $userType = "LOGIN") :array {
        $pagination = new Pagination($page, $pageSize);
        $offset = $pagination->getOffset();
        $limit = $pagination->getLimit();
        $userTyped = UserType::make($userType);
        $usersData = $this->userRepository->findFilterAndPaginated($offset, $limit, $userTyped);
        $users = array_map(
            function (User $user){
                $emails = array_map(fn(Email $email) => $email->email(), $user->getEmails());
                return new UserDTO(
                    $user->getId(),
                    $user->getType()->getName(),
                    $user->getName(),
                    $emails
                );
            },
            $usersData
        );
        return $users;
    }
        /**
         * @param string $id
         * @return UserAccountDTO
         */
        public function listUserData(string $id): UserAccountDTO{
            $userDto = new UserAccountDTO();
            $user = $this->userRepository->findByIdCode(new IdentifierCode($id));

            if(!is_null($user)){
                $emails = array_map(fn(Email $email) => $email->email(), $user->getEmails());
                $userDto->id = $user->getId();
                $userDto->userType = $user->getType()->getName();
                $userDto->name = $user->getName();
                $userDto->emails = $emails;
                if(is_null($user->getFinancialEntity())){
                    return $userDto;
                }
                $userDto->taxpayer =
                    $user->getFinancialEntity()
                         ->getTaxpayer();
                $userDto->account =
                    $user->getFinancialEntity()
                         ->getAccount()
                         ->getBalance();
            }

            return $userDto;
        }
}
