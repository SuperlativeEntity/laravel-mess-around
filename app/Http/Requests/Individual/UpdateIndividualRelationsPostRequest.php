<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateIndividualRelationsPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.individual.update');
    }

    public function rules()
    {
        return
        [
            'organisation_id'       => 'required|numeric',
            'organisation_type_id'  => 'required|numeric',
            'individual_id'         => 'required|numeric',
            'roles'                 => 'sometimes|required',
        ];
    }
}