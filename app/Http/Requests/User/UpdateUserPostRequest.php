<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateUserPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.user.update');
    }

    public function rules()
    {
        return
        [
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'email'         => 'email|max:254',
            'password'      => 'case_diff|numbers|letters|symbols|min:'.config('system.min_password_length').'|max:254',
        ];
    }
}
