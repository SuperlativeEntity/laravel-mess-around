<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class LinkIndividualPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.individual.link');
    }

    public function rules()
    {
        return
        [
            'organisation_id'   => 'required|numeric',
            'id_number_link'    => 'required'
        ];
    }
}