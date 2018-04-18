<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndividualPostRequest;
use App\Http\Requests\UpdateIndividualPostRequest;
use App\Http\Requests\LinkIndividualPostRequest;
use App\Http\Requests\UnlinkIndividualPostRequest;
use App\Http\Requests\UpdateIndividualRelationsPostRequest;
use App\Repositories\IOrganisationIndividualRepository as OrganisationIndividualRepository;
use App\Repositories\IOrganisationRepository as OrganisationRepository;
use App\Individual;

class OrganisationIndividualController extends Controller
{
    protected $organisation;
    protected $individual;

    public function __construct(OrganisationRepository $organisation,OrganisationIndividualRepository $individual)
    {
        $this->organisation = $organisation;
        $this->individual   = $individual;
    }

    public function getModify($id = null)
    {
        $args                       = [];
        $args['organisation']       = $this->organisation->findById($id);
        $args['building_count']     = $args['organisation']->buildings->count();
        $args['individual_count']   = $args['organisation']->individuals(config('role.claimant'))->count();

        // if no individuals have been captured as yet and it is a private individual case, populate the case details in the individual fields
        if ((int)$args['individual_count'] === 0 && (int)$args['organisation']->organisation_type_id === config('organisation.private_individual'))
        {
            $args['individual']             = new Individual();
            $explodeName                    = explode(" ",$args['organisation']->name);
            $args['individual']->first_name = isset($explodeName[0]) ? $explodeName[0] : null;
            $args['individual']->last_name  = isset($explodeName[1]) ? $explodeName[1] : null;
            $args['individual']->id_number  = $args['organisation']->registration_number;
            $args['individual']->home       = $args['organisation']->phone;
            $args['individual']->email      = $args['organisation']->email;
        }

        return view('admin.organisations.individuals.manage')->with($args);
    }

    public function postStore(StoreIndividualPostRequest $request)
    {
        return $this->individual->create($request);
    }

    public function postUpdate(UpdateIndividualPostRequest $request)
    {
        return $this->individual->update($request);
    }

    public function postLink(LinkIndividualPostRequest $request)
    {
        $response = $this->individual->link($request);

        return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    }

    public function postUnlink(UnlinkIndividualPostRequest $request)
    {
        $response = $this->individual->unlink($request);

        return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    }

    public function getRecord($id = null)
    {
        return $this->individual->findById($id);
    }

    public function getOrganisationIndividuals($parent_id,Request $request)
    {
        return response()->json($this->individual->getOrganisationIndividuals($parent_id,$request));
    }

    public function getIndividualOrganisations($id,Request $request)
    {
        return response()->json($this->individual->getIndividualOrganisations($id,$request));
    }

    public function getIndividualNonMemberOrganisations($id)
    {
        return response()->json($this->individual->nonMemberOrganisations($id));
    }

    public function updateRelations(UpdateIndividualRelationsPostRequest $request)
    {
        $response = $this->individual->updateRelations($request);

        return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    }

    public function linkIndividualToOrganisations(Request $request)
    {
        $response = $this->individual->linkIndividualToOrganisations($request);

        return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    }
}