<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Http\Requests\StoreCampaignPostRequest;
use App\Http\Requests\UpdateCampaignPostRequest;

interface ICampaignRepository
{
    public function findById($id);
    public function findByFieldValue($field,$value);
    public function create(StoreCampaignPostRequest $request);
    public function update(UpdateCampaignPostRequest $request);
    public function gridList(Request $request);
    public function cleanupSmsMessage(Request $request);
    public function cleanupContacts(Request $request);
}