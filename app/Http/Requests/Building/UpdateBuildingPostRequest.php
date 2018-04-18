<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateBuildingPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.building.update');
    }

    public function rules()
    {
        return
        [
            'province_id'           => 'numeric',
            'district_id'           => 'required|numeric',
            'building_type_id'      => 'sometimes|numeric',
            'valcon_registered_id'  => 'required|numeric',
            'erf'                   => 'required|unique:buildings,erf,'.$this->building_id,
            'building_name'         => 'required|unique:buildings,name,'.$this->building_id,
        ];
    }
}