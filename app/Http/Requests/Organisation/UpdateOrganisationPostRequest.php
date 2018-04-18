<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateOrganisationPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.update');
    }

    public function rules()
    {
        $rules =
        [
            'organisation_type_id'  => 'required|numeric',
            'name'                  => 'required|unique:organisations,name,'.$this->id,
            'phone'                 => 'sometimes|numeric',
            'email'                 => 'sometimes|email',
            'fax'                   => 'numeric',
        ];

        return $rules;
    }
}
