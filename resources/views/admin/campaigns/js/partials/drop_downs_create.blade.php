var campaign_type       = renderDropDown({ element:campaign_type_id, option:'@lang('campaign.campaign_type_select')', url:'{{ route('admin.drop_down.list',['name' => 'CampaignType']) }}' });
var campaign_category   = renderDropDown({ element:campaign_category_id, option:'@lang('campaign.campaign_category_select')', url:'{{ route('admin.drop_down.list',['name' => 'CampaignCategory']) }}' });