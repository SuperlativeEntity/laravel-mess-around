<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class GenerateBuildingPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.building.generate');
    }

    public function rules()
    {
        return
        [
            'organisation_id'           => 'required|numeric',
            'generate_building_type_id' => 'required|numeric',
            'generate_buildings'        => 'required|numeric',
        ];
    }
}