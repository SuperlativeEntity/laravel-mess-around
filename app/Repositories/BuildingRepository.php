<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Building;
use App\Helpers\GeneralHelper;
use App\Http\Requests\StoreBuildingPostRequest;
use App\Http\Requests\UpdateBuildingPostRequest;
use App\Http\Requests\GenerateBuildingPostRequest;
use App\Repositories\IUserRepository as UserRepo;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;
use App\Repositories\IOrganisationRepository as OrganisationRepo;

class BuildingRepository implements IBuildingRepository
{
    protected   $helper;
    protected   $user;
    protected   $organisation;
    private     $gridColumns    = [];
    private     $table          = 'buildings';

    public function __construct(MySQLDatabaseHelper $helper,UserRepo $user,OrganisationRepo $organisation)
    {
        $this->helper       = $helper;
        $this->user         = $user;
        $this->organisation = $organisation;
    }

    public function findById($id)
    {
        return Building::findOrFail($id);
    }

    public function create(StoreBuildingPostRequest $request)
    {
        return $this->manage($request);
    }

    public function update(UpdateBuildingPostRequest $request)
    {
        return $this->manage($request);
    }

    private function manage(Request $request)
    {
        $building_id            = $request->has('building_id') ? $request->input('building_id') : null;
        $linked_to              = $request->has('linked_to') ? $request->input('linked_to') : null; // e.g. organisation
        $parent_model           = config('system.default_namespace').'\\'.studly_case($linked_to); // E.g. Organisation
        $parent_id              = $request->has($linked_to.'_id') ? $request->input($linked_to.'_id') : null; // e.g. organisation_id
        $parent                 = $parent_model::findOrFail($parent_id);

        $building               = Building::findOrNew($building_id);

        if (isset($building) && isset($parent))
        {
            $building->building_type_id     = ($request->has('building_type_id') && (int)$request->input('building_type_id') > 0) ? (int)$request->input('building_type_id') : null;
            $building->name                 = $request->input('building_name');
            $building->erf                  = $request->input('erf');
            $building->province_id          = ($request->has('province_id') && (int)$request->input('province_id') > 0) ? (int)$request->input('province_id') : null;
            $building->district_id          = $request->input('district_id');
            $building->valuation_amount     = ($request->has('valuation_amount') && (double)$request->input('valuation_amount') > 0) ? (double)$request->input('valuation_amount') : 0;
            $building->valcon_registered_id = $request->input('valcon_registered_id');
            $building->valcon_number        = ($request->has('valcon_number') && $request->input('valcon_number') <> '') ? $request->input('valcon_number') : null;
            $building->address              = ($request->has('address') && $request->input('address') <> '') ? $request->input('address') : null;

            if (empty($building_id))
                $building->created_by = $this->user->get()->id;

            if (isset($building_id))
                $building->updated_by = $this->user->get()->id;

            if ($building->save())
            {
                if (empty($building_id)) // only attach if a new record is created
                    $parent->buildings()->attach([$building->id]);

                return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('building.successfully_saved')]];
            }
        }

        return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('building.failed_to_save')]];
    }

    public function gridList($id,Request $request)
    {
        $request            = json_decode(json_encode($request->query()), FALSE);
        $dataSource         = $this->helper->getDataSourceResult();

        $dataSourceSql      = str_replace(":organisation_id",$id,config('building.grid_sql'));
        $dataSourceCount    = str_replace(":organisation_id",$id,config('building.grid_sql_count'));

        return $dataSource->read($this->table,$this->gridColumns,$request,$dataSourceSql,$dataSourceCount);
    }

}