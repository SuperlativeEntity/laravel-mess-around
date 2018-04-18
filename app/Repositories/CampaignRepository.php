<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Campaign;

use App\Repositories\IUserRepository as UserRepo;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;

use App\Http\Requests\StoreCampaignPostRequest;
use App\Http\Requests\UpdateCampaignPostRequest;

class CampaignRepository implements ICampaignRepository
{
    protected   $helper;
    protected   $user;
    private     $gridColumns    = [];
    private     $table          = 'campaigns';

    public function __construct(MySQLDatabaseHelper $helper,UserRepo $user)
    {
        $this->helper       = $helper;
        $this->user         = $user;
    }

    public function findById($id)
    {
        return Campaign::findOrFail($id);
    }

    public function findByFieldValue($field,$value)
    {
        return Campaign::where($field,$value)->first();
    }

    public function create(StoreCampaignPostRequest $request)
    {
        return $this->manage($request);
    }

    public function update(UpdateCampaignPostRequest $request)
    {
        return $this->manage($request);
    }

    private function manage(Request $request)
    {
        $campaign_id            = $request->has('campaign_id') ? $request->input('campaign_id') : null;
        $campaign               = Campaign::findOrNew($campaign_id);

        if (isset($campaign))
        {
            $campaign->campaign_type_id     = (int)$request->input('campaign_type_id');
            $campaign->campaign_category_id = (int)$request->input('campaign_category_id');
            $campaign->name                 = $request->input('name');
            $campaign->message              = $request->has('message') ? $request->input('message') : null;
            $campaign->start_date           = $request->input('start_date');

            if (empty($individual_id))
                $campaign->created_by = $this->user->get()->id;

            if (isset($individual_id))
                $campaign->updated_by = $this->user->get()->id;

            if ($campaign->save())
            {

                $message    = $request->has('campaign_id') ? trans('campaign.successfully_updated') : trans('campaign.successfully_created');
                $response   = ['success' => true, 'code' => config('http_code.ok'), 'messages' => [$message]];

                if (empty($campaign_id))
                {
                    $response['id']             = $campaign->id;
                    $response['redirect_url']   = route('admin.campaign.modify');
                }

                return $response;
            }
        }

        return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.failed_to_save')]];
    }

    public function gridList(Request $request)
    {
        $request            = json_decode(json_encode($request->query()), FALSE);
        $dataSource         = $this->helper->getDataSourceResult();

        return $dataSource->read($this->table,$this->gridColumns,$request,config('campaign.grid_sql'),config('campaign.grid_sql_count'));
    }

    public function cleanupSmsMessage(Request $request)
    {
        $response   = ['success' => true,'code' => config('http_code.ok')];
        $campaign   = $this->findById($request->input('campaign_id'));
        $message    = $request->input('sms_message');

        if (strlen($message) === 0)
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => ['Sms Message needs to be filled in']];

        foreach (config('sms.replace_characters') as $key => $value)
        {
            $message = str_replace($key,$value,$message);
        }

        $message = preg_replace("/\s+/", " ", $message);
        $message = trim($message);

        $campaign->message = $message;
        $campaign->save();

        $response['sms_message'] = $message;

        return $response;
    }

    public function cleanupContacts(Request $request)
    {
        $response           = ['success' => true,'code' => config('http_code.ok')];

        $campaign           = $this->findById($request->input('campaign_id'));
        $explodeContacts    = explode("\r\n",$request->input('campaign_contacts'));

        $emails             = [];
        $mobileNumbers      = [];

        if (count($explodeContacts) === 0)
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => ['Cannot find any Contacts to process']];

        foreach ($explodeContacts as $contactLine)
        {
            $explodeLine = explode(",",$contactLine);

            foreach ($explodeLine as $lineEntry)
            {
                $lineEntry              = trim($lineEntry);
                $lineEntry              = str_replace("'","",$lineEntry);
                $lineEntry              = str_replace("``","",$lineEntry);
                $lineEntry              = str_replace("(","",$lineEntry);
                $lineEntry              = str_replace(")","",$lineEntry);
                $lineEntryRemoveNumbers = preg_replace('/\D/', '', $lineEntry);
                $lineEntryRemoveNumbers = (double)$lineEntryRemoveNumbers;

                if (!filter_var($lineEntry, FILTER_VALIDATE_EMAIL) === false)
                    array_push($emails,strtolower($lineEntry));

                if ($lineEntryRemoveNumbers > 0 && strlen($lineEntryRemoveNumbers) >= 9)
                {
                    if (!in_array(substr($lineEntryRemoveNumbers,0,1),config('sms.supported_ranges')) && substr($lineEntryRemoveNumbers,0,2) != config('campaign.country_code'))
                        continue;

                    if (substr($lineEntryRemoveNumbers,0,2) != config('campaign.country_code'))
                        $lineEntryRemoveNumbers = config('campaign.country_code').$lineEntryRemoveNumbers;

                    if (strlen($lineEntryRemoveNumbers) === 11)
                        array_push($mobileNumbers,$lineEntryRemoveNumbers);
                }
            }
        }

        $emailsUnique           = array_unique($emails);
        $emailsUnique           = array_values($emailsUnique);

        $mobileNumbersUnique    = array_unique($mobileNumbers);
        $mobileNumbersUnique    = array_values($mobileNumbersUnique);

        asort($emailsUnique);
        asort($mobileNumbersUnique);

        // only return a list of email addresses if it is an email campaign
        if ((int)$campaign->campaign_type_id === (int)config('campaign.email'))
            $response['contacts'] = implode("\r\n",$emailsUnique);

        // only return a list of mobile numbers if it is a sms campaign
        if ((int)$campaign->campaign_type_id === (int)config('campaign.sms'))
            $response['contacts'] = implode("\r\n",$mobileNumbersUnique);

        // store the contacts on the campaign
        $campaign->contacts         = $response['contacts'];
        $campaign->contacts_count   = ((int)$campaign->campaign_type_id === (int)config('campaign.sms')) ? count($mobileNumbersUnique) : count($emailsUnique);
        $campaign->save();

        $response['contacts_count'] = $campaign->contacts_count;

        return $response;
    }
}