<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuildingPostRequest;
use App\Http\Requests\UpdateBuildingPostRequest;
use App\Http\Requests\GenerateBuildingPostRequest;
use App\Repositories\IBuildingRepository as BuildingRepository;
use App\Repositories\IOrganisationRepository as OrganisationRepository;

class BuildingController extends Controller
{
    protected $organisation;
    protected $building;

    public function __construct(OrganisationRepository $organisation,BuildingRepository $building)
    {
        $this->organisation = $organisation;
        $this->building     = $building;
    }

    public function getModify($id = null)
    {
        $args                   = [];
        $args['organisation']   = $this->organisation->findById($id);

        return view('admin.organisations.buildings.manage')->with($args);
    }

    public function getRecord($id = null)
    {
        return $this->building->findById($id);
    }

    public function postStore(StoreBuildingPostRequest $request)
    {
        return $this->building->create($request);
    }

    public function postUpdate(UpdateBuildingPostRequest $request)
    {
        return $this->building->update($request);
    }

    public function postGenerate(GenerateBuildingPostRequest $request)
    {
        $response = $this->building->generate($request);

        return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    }

    public function getList($parent_id,Request $request)
    {
        $data = $this->building->gridList($parent_id,$request);
        return response()->json($data);
    }
}