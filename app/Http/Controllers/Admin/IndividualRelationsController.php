<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\IOrganisationIndividualRepository as OrganisationIndividualRepository;

class IndividualRelationsController extends Controller
{
    protected $individual;

    public function __construct(OrganisationIndividualRepository $individual)
    {
        $this->individual = $individual;
    }

    /**
     * Return an array of Role Ids for an Individual for a specific Organisation
     * Typically used to re-populate multi-select controls
     *
     * @param $organisation_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoleIdsByOrganisation($organisation_id,$id)
    {
        return response()->json(['roles'=>$this->individual->getRoleIdsByOrganisation($organisation_id,$id)]);
    }

    /***
     * Return an array of Building Ids for an Individual for a specific Organisation
     * Typically used to re-populate multi-select controls
     *
     * @param $organisation_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBuildingIdsByOrganisation($organisation_id,$id)
    {
        return response()->json(['buildings'=>$this->individual->getBuildingIdsByOrganisation($organisation_id,$id)]);
    }
}