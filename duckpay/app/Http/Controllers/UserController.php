<?php

namespace App\Http\Controllers;

use App\Application\User\UserSevice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserSevice $userSevice;
    public function __construct(UserSevice $userSevice)
    {
        $this->userSevice = $userSevice;
    }
    public function index(Request $request): View
    {
        $type = $request->get('type', 'LOGIN');
        $page = $request->get('page', 1);
        $users = $this->userSevice->listUsersFilterByTypeWithPagination(1, $page * 10, $type);
        $userCount = $this->userSevice->countUsersFilterByTypeForPagination($type);
        $endpage = $userCount > count($users);
        return view('users.index', compact('users', 'type', 'page', 'endpage', 'userCount'));
    }
}
