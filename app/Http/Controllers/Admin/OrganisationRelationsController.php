<?php

namespace App\Http\Controllers\Admin;

use App\Organisation;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use App\Repositories\IOrganisationRepository as OrganisationRepository;

class OrganisationRelationsController extends Controller
{
    protected $organisation;

    public function __construct(OrganisationRepository $organisation)
    {
        $this->organisation = $organisation;
    }

    public function getAll()
    {
        $query = Organisation::orderBy('created_at','desc');

        if (GeneralHelper::isArrayWithValues(session('individual_organisation_ids')))
            $query->whereIn('id',session('individual_organisation_ids'));

        $query = $query->get();

        return response()->json($query);
    }

    public function getOrphans()
    {
        return response()->json($this->organisation->orphans());
    }

    public function getHierarchy($id)
    {
        $args                   = [];
        $args['organisation']   = $this->organisation->findById($id);
        $args['hierarchy']      = $this->organisation->hierarchy($id);

        return view('admin.organisations.hierarchy.display')->with($args);
    }

    public function getRecent($take = 5)
    {
        return response()->json($this->organisation->recent($take));
    }
}
