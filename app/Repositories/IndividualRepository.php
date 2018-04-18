<?php

namespace App\Repositories;

use App\Helpers\GeneralHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\User;
use App\Individual;
use App\Http\Requests\StoreIndividualPostRequest;
use App\Http\Requests\UpdateIndividualPostRequest;
use App\Repositories\IUserRepository as UserRepo;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;
use App\Events\Individual\AccountCreatedEvent;

class IndividualRepository implements IIndividualRepository
{
    protected   $helper;
    protected   $user;
    private     $gridColumns    = [];
    private     $table          = 'individuals';

    public function __construct(MySQLDatabaseHelper $helper,UserRepo $user)
    {
        $this->helper       = $helper;
        $this->user         = $user;
    }

    public function findById($id)
    {
        return Individual::findOrFail($id);
    }

    public function findByFieldValue($field,$value)
    {
        return Individual::where($field,$value)->first();
    }

    public function organisations($id)
    {
        $organisations = [];

        foreach ($this->findById($id)->organisations as $organisation)
        {
            $organisations[$organisation->id] = $organisation;
        }

        return GeneralHelper::flattenArray($organisations);
    }

    public function organisationIds($id)
    {
        $organisationIds = [];

        foreach ($this->organisations($id) as $organisation)
        {
            array_push($organisationIds,$organisation->id);
        }

        return $organisationIds;
    }

    public function create(StoreIndividualPostRequest $request)
    {
        return $this->manage($request);
    }

    public function update(UpdateIndividualPostRequest $request)
    {
        return $this->manage($request);
    }

    /**
     * Keep the setting of values in one place
     *
     * @param Request $request
     * @param Individual $individual
     * @param $individual_id
     * @return Individual
     */
    public function setValues(Request $request,Individual $individual,$individual_id)
    {
        $individual->title_id           = ($request->has('title_id') && (int)$request->input('title_id') > 0) ? (int)$request->input('title_id') : null;
        $individual->language_id        = (int)$request->input('language_id');
        $individual->nationality_id     = (int)$request->input('nationality_id');

        $individual->initials           = ($request->has('initials') && $request->input('initials') != '') ? $request->input('initials') : null;
        $individual->first_name         = ($request->has('first_name') && $request->input('first_name') != '') ? $request->input('first_name') : null;
        $individual->last_name          = $request->input('last_name');
        $individual->id_number          = ($request->has('id_number') && $request->input('id_number') != '') ? $request->input('id_number') : null;
        $individual->birth_date         = ($request->has('birth_date') && $request->input('birth_date') != '') ? $request->input('birth_date') : null;
        $individual->join_date          = ($request->has('join_date') && $request->input('join_date') != '') ? $request->input('join_date') : date('Y-m-d');

        $individual->mobile             = ($request->has('mobile') && $request->input('mobile') != '') ? $request->input('mobile') : null;
        $individual->mobile_secondary   = ($request->has('mobile_secondary') && $request->input('mobile_secondary') != '') ? $request->input('mobile_secondary') : null;
        $individual->home               = ($request->has('home') && $request->input('home') != '') ? $request->input('home') : null;
        $individual->work               = ($request->has('work') && $request->input('work') != '') ? $request->input('work') : null;
        $individual->email              = $request->input('individual_email');
        $individual->email_secondary    = ($request->has('email_secondary') && $request->input('email_secondary') != '') ? $request->input('email_secondary') : null;

        $individual->communication      = ($request->has('communication') && $request->input('communication') != '') ? $request->input('communication') : null;
        $individual->newsletter         = ($request->has('newsletter') && $request->input('newsletter') != '') ? $request->input('newsletter') : null;

        if (empty($individual_id))
            $individual->created_by = $this->user->get()->id;

        if (isset($individual_id))
            $individual->updated_by = $this->user->get()->id;

        return $individual;
    }

    // create or update an individual (outside the perspective of an organisation)
    private function manage(Request $request)
    {
        $individual_id          = $request->has('individual_id') ? $request->input('individual_id') : null;
        $individual             = Individual::findOrNew($individual_id);

        if (isset($individual))
        {
            $this->setValues($request,$individual,$individual_id);

            if ($individual->save())
            {
                $response = ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('individual.successfully_saved')]];

                // redirect to modify view with created individual loaded
                if (empty($individual_id))
                {
                    $response['id']             = $individual->id;
                    $response['redirect_url']   = route('admin.individual.modify');
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

        return $dataSource->read($this->table,$this->gridColumns,$request,config('individual.grid_sql'),config('individual.grid_sql_count'));
    }

    public function createAccount(Request $request)
    {
        $individual_id = $request->has('individual_id') ? $request->input('individual_id') : null;

        if (empty($individual_id))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => ['individual_id expected']];

        $individual = Individual::findOrFail($individual_id);

        if (empty($individual))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.missing')]];

        $email  = Str::lower($individual->email);
        $exists = User::where('email',$email)->count();

        if ((int)$exists > 0)
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => ['A User Account with this email already exists']];

        try
        {
            $user = $this->user->providerCreate($individual->first_name,$individual->last_name,$email,str_random(10));

            if ($user)
            {
                $individual->user_id = $user->id;
                $individual->save();

                $this->user->attachUserToRole($user,config('role.claimant'));

                // send mail to individual
                event(new AccountCreatedEvent($user,$individual));
            }
        }
        catch (\Exception $e)
        {
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => ['Error in creating User Account'.$e->getMessage()]];
        }

        return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('individual.account_created')]];
    }
}