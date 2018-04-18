<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class AssignUserRolePostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.user.assign_roles');
    }

    public function rules()
    {
        return
        [
            'roles'     => 'required',
            'user_id'   => 'required|numeric'
        ];
    }
}