<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class ManageAddressPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.member.addresses.manage');
    }

    public function rules()
    {
        return
        [
            'physical_street_postbox'   => 'required',
            'postal_street_postbox'     => 'required',
            'physical_province_id'      => 'required|numeric',
            'postal_province_id'        => 'required|numeric',
            'physical_postal_code'      => 'required|numeric|digits:4',
            'postal_postal_code'        => 'required|numeric|digits:4',
        ];
    }
}
