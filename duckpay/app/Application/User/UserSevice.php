<?php

namespace App\Application\User;

use App\Application\Pagination;
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
    public function listUsersFilterByTypeWithPagination(int $page=1, int $pageSize=10, array $filter = array()) :array {
        $pagination = new Pagination($page, $pageSize);
        $offset = $pagination->getOffset();
        $limit = $pagination->getLimit();
        $userType = UserType::make();
        $usersData = $this->userRepository->findFilterAndPaginated($offset, $limit, $userType);
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
}
