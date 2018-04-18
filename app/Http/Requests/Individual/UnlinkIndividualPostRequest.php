<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UnlinkIndividualPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.individual.unlink');
    }

    public function rules()
    {
        return
        [
            'organisation_id'   => 'required|numeric',
            'individual_id'     => 'required|numeric'
        ];
    }
}