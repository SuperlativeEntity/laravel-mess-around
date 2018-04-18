<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganisationPostRequest;
use App\Http\Requests\UpdateOrganisationPostRequest;
use App\Repositories\IOrganisationRepository as OrganisationRepository;
use App\Helpers\GeneralHelper;
use App\OrganisationIndividual;

class OrganisationController extends Controller
{
    protected $organisation;

    public function __construct(OrganisationRepository $organisation)
    {
        $this->organisation = $organisation;
    }

    public function getCreate()
    {
        $args = [];

        return view('admin.organisations.create')->with($args);
    }

    public function getModify($id = null)
    {
        // if the user tries to access an organisation that is not theirs, redirect to list of organisations
        if (GeneralHelper::isArrayWithValues(session('individual_organisation_ids')) && !in_array($id,session('individual_organisation_ids')))
            return view('admin.organisations.index');

        $args                           = null;
        $args['manage_buildings']       = false;
        $args['organisation']           = isset($id) ? $this->organisation->findById($id) : null;
        $args['parent']                 = ($args['organisation']->parent->count() > 0) ? $args['organisation']->parent : null;
        $args['individual_count']       = OrganisationIndividual::where('organisation_id',$id)->count();
        $args['service_provider_count'] = $args['organisation']->individuals(config('role.service_provider'))->count();
        $args['building_count']         = $args['organisation']->buildings->count();

        // can buildings be captured under this type of organisation?
        if (in_array($args['organisation']->organisation_type_id,config('organisation.has_buildings')))
            $args['manage_buildings'] = true;

        return view('admin.organisations.modify')->with($args);
    }

    public function getIndex()
    {
        return view('admin.organisations.index');
    }

    public function getIndexHtml()
    {
        return view('admin.organisations.index_html');
    }

    public function postStore(StoreOrganisationPostRequest $request)
    {
        $response =  $this->organisation->create($request);

        return response()->json($response,$response['code']);
    }

    public function postUpdate(UpdateOrganisationPostRequest $request)
    {
        $response = $this->organisation->update($request);

        return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    }
    
    public function getList(Request $request)
    {
        $data = $this->organisation->gridList($request);

        return response()->json($data);
    }

    public function getRecord($id)
    {
        return $this->organisation->findById($id);
    }
}
