<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateIndividualPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.individual.update');
    }

    public function rules()
    {
        return
        [
            'organisation_id'   => 'sometimes|required|numeric',

            'title_id'          => 'sometimes|numeric',
            'language_id'       => 'required|numeric',
            'nationality_id'    => 'required|numeric',

            'last_name'         => 'required',
            'birth_date'        => 'date|before:' . date('Y-m-d'),
            'join_date'         => 'date|after:' . date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day')),

            'individual_email'  => 'email|max:254|unique:individuals,email,'.$this->individual_id,
            'email_secondary'   => 'email|max:254',
            'home'              => 'numeric',
            'mobile'            => 'numeric',
            'mobile_secondary'  => 'numeric',
            'work'              => 'numeric',
            'fax'               => 'numeric',
        ];
    }
}