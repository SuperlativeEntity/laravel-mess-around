<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignPostRequest;
use App\Http\Requests\UpdateCampaignPostRequest;
use App\Repositories\ICampaignRepository as CampaignRepository;

class CampaignController extends Controller
{
    protected $campaign;

    public function __construct(CampaignRepository $campaign)
    {
        $this->campaign = $campaign;
    }

    public function getCreate()
    {
        return view('admin.campaigns.create');
    }

    public function getModify($id = null)
    {
        $args = null; // easier to extend

        if (isset($id))
            $args['campaign'] = $this->campaign->findById($id);

        return view('admin.campaigns.modify')->with($args);
    }

    public function getIndex()
    {
        return view('admin.campaigns.index');
    }

    public function getIndexHtml()
    {
        return view('admin.campaigns.index_html');
    }

    public function getContacts(Request $request)
    {
        return view('admin.campaigns.tab_content.contacts')->with(['campaign'=>$this->campaign->findById((int)$request->id)]);
    }

    public function postCleanupContacts(Request $request)
    {
        $response = $this->campaign->cleanupContacts($request);

        return response()->json($response,$response['code']);
    }

    public function postStore(StoreCampaignPostRequest $request)
    {
        return $this->campaign->create($request);
    }

    public function postUpdate(UpdateCampaignPostRequest $request)
    {
        return $this->campaign->update($request);
    }

    public function getList(Request $request)
    {
        $data = $this->campaign->gridList($request);
        return response()->json($data);
    }
    
    public function get($id)
    {
        $campaign = $this->campaign->findById((int)$id);

        if ($campaign == null)
            return response()->json(['error' => 'campaign_not_found'],422);

        return response()->json($campaign);
    }

    public function getSmsMessage(Request $request)
    {
        return view('admin.campaigns.tab_content.sms_message')->with(['campaign'=>$this->campaign->findById((int)$request->id)]);
    }

    public function postCleanupSms(Request $request)
    {
        $response = $this->campaign->cleanupSmsMessage($request);

        return response()->json($response,$response['code']);
    }
}
