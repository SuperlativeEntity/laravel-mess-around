<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ErrorHelper;
use App\Http\Controllers\Controller;
use App\Repositories\OrganisationRepository;

class BuildingRelationsController extends Controller
{
    protected $organisationRepository;
    protected $individualRepository;

    public function __construct(OrganisationRepository $organisationRepository)
    {
        $this->organisationRepository = $organisationRepository;
    }

    public function getByOrganisation($id)
    {
        $organisation = $this->organisationRepository->findById($id);

        if (empty($organisation))
            return ErrorHelper::failed(trans('organisation.missing'));

        if ($organisation->buildings->count() === 0)
            return ErrorHelper::failed(trans('organisation.no_buildings'));

        if (isset($organisation))
            return response()->json($organisation->buildings);
    }

    public function countByOrganisation($id)
    {
        $organisation = $this->organisationRepository->findById($id);

        if (empty($organisation))
            return ErrorHelper::failed(trans('organisation.missing'));

        if (isset($organisation))
            return response()->json(['count'=>$organisation->buildings->count()]);
    }
}