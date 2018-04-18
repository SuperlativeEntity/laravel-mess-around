<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateCampaignPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.campaign.update');
    }

    public function rules()
    {
        return
        [
            'name'                  => 'required|unique:campaigns,name,'.$this->campaign_id,
            'campaign_type_id'      => 'required|numeric',
            'campaign_category_id'  => 'required|numeric',
            'start_date'            => 'required|date|after:yesterday',
        ];
    }
}
