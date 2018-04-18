<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class StoreUserPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.user.store');
    }

    public function rules()
    {
        return
        [
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'password'      => 'required|case_diff|numbers|letters|symbols|min:'.config('system.min_password_length'),
            'email'         => 'email|max:254|unique:users',
        ];
    }
}
