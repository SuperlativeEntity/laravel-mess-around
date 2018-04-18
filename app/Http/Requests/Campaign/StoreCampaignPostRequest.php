<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class StoreCampaignPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.campaign.store');
    }

    public function rules()
    {
        return
        [
            'name'                  => 'required|max:255|unique:campaigns,name',
            'campaign_type_id'      => 'required|numeric',
            'campaign_category_id'  => 'required|numeric',
            'start_date'            => 'required|date|after:yesterday',
        ];
    }
}
