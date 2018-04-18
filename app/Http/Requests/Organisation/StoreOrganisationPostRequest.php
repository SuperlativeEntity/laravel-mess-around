<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class StoreOrganisationPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.store');
    }

    public function rules()
    {
        $rules =
        [
            'organisation_type_id'  => 'required|numeric',
            'name'                  => 'required|unique:organisations,name',
            'phone'                 => 'sometimes|numeric',
            'email'                 => 'sometimes|email',
            'fax'                   => 'numeric',
        ];

        return $rules;
    }
}