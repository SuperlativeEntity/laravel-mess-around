<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\IUserRepository as UserRepository;

class UserComposer
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function compose(View $view)
    {
        $view->with
        ([
            'current_user'  => $this->user->get(),
            'login_url'     => route('auth.login')
        ]);
    }
}