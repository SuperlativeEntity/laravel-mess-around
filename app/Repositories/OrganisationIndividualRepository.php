<?php

namespace App\Repositories;

use DB;
use Illuminate\Http\Request;

use App\Individual;
use App\IndividualBuilding;
use App\OrganisationIndividual;

use App\Http\Requests\StoreIndividualPostRequest;
use App\Http\Requests\UpdateIndividualPostRequest;
use App\Http\Requests\LinkIndividualPostRequest;
use App\Http\Requests\UnlinkIndividualPostRequest;
use App\Http\Requests\UpdateIndividualRelationsPostRequest;

use App\Repositories\IUserRepository as UserRepo;
use App\Repositories\IOrganisationRepository as OrganisationRepo;
use App\Repositories\IIndividualRepository as IndividualRepo;

use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;
use App\Helpers\GeneralHelper;

// managing individuals from the individuals tab on an organisation

class OrganisationIndividualRepository implements IOrganisationIndividualRepository
{
    protected   $helper;
    protected   $user;
    protected   $organisation;
    protected   $individual;
    private     $gridColumns    = [];
    private     $table          = 'individuals';

    public function __construct(MySQLDatabaseHelper $helper,UserRepo $user,OrganisationRepo $organisation, IndividualRepo $individual)
    {
        $this->helper       = $helper;
        $this->user         = $user;
        $this->organisation = $organisation;
        $this->individual   = $individual;
    }

    public function findById($individual_id)
    {
        return $this->individual->findById($individual_id);
    }

    public function findByFieldValue($field,$value)
    {
        return $this->individual->findByFieldValue($field,$value);
    }

    public function create(StoreIndividualPostRequest $request)
    {
        return $this->manage($request);
    }

    public function update(UpdateIndividualPostRequest $request)
    {
        return $this->manage($request);
    }

    // capturing or updating an individual from an organisation perspective
    private function manage(Request $request)
    {
        $individual_id          = $request->has('individual_id') ? $request->input('individual_id') : null;

        // e.g. organisation
        $linked_to              = $request->has('linked_to') ? $request->input('linked_to') : null;

        // e.g. App\Organisation
        $parent_model           = config('system.default_namespace').'\\'.studly_case($linked_to);

        // e.g. organisation_id
        $parent_id              = $request->has($linked_to.'_id') ? $request->input($linked_to.'_id') : null;

        // e.g. App\Organisation
        $parent                 = $parent_model::findOrFail($parent_id);
        $individual             = Individual::findOrNew($individual_id);

        $roles                  = $request->has('roles') ? $request->input('roles') : null;
        $buildings              = $request->has('buildings') ? $request->input('buildings') : null;

        $assign_roles           = GeneralHelper::isArrayWithValues($roles) ? $roles : [$roles];
        $assign_buildings       = GeneralHelper::isArrayWithValues($buildings) ? $buildings : [$buildings];

        if (isset($individual))
        {
            $this->individual->setValues($request,$individual,$individual_id);

            if ($individual->save())
            {
                if (isset($parent))
                {
                    if (empty($individual_id)) // when creating the individual
                    {
                        // attach roles according to organisation
                        if (isset($roles))
                        {
                            foreach ($assign_roles as $role)
                            {
                                $map = $this->mapRole([$parent->id],$role);
                                $individual->organisations()->attach($map);
                            }
                        }

                        // attach buildings
                        if (isset($buildings))
                        {
                            foreach ($assign_buildings as $building)
                            {
                                $individual->buildings()->attach($building);
                            }
                        }
                    }

                    if (isset($individual_id)) // when updating the individual
                    {
                        $this->detachRolesForOrganisation($parent->id,$individual->id);

                        foreach ($assign_roles as $role) // attach updated roles
                        {
                            $map = $this->mapRole([$parent->id],$role);
                            $individual->organisations()->attach($map);
                        }

                        // detach buildings for individuals
                        $this->detachBuildingsFromOrganisation($parent->id,$individual->id);

                        foreach ($assign_buildings as $building) // attach updated buildings
                        {
                            if ((int)$building > 0)
                                $individual->buildings()->attach([$building]);
                        }
                    }
                }

                return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('individual.successfully_saved')]];
            }
        }

        return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.failed_to_save')]];
    }

    private function mapRole($parents,$role)
    {
        $map = [];

        if (GeneralHelper::isArrayWithValues($parents))
        {
            $pivotData  = array_fill(0, count($parents), ['role_id' => $role]);
            $map        = array_combine($parents, $pivotData);
        }

        return $map;
    }

    private function detachRolesForOrganisation($organisation_id,$individual_id)
    {
        DB::table('organisation_individuals')->
        where('organisation_id','=',$organisation_id)->
        where('individual_id','=',$individual_id)->
        delete();
    }

    private function detachBuildingsFromOrganisation($organisation_id,$individual_id)
    {
        $buildings = $this->getBuildingIdsByOrganisation($organisation_id,$individual_id);

        if ($buildings->count() > 0)
        {
            foreach ($buildings as $building_id)
            {
                DB::table('individual_buildings')->
                where('individual_id','=',$individual_id)->
                where('building_id','=',$building_id)->
                delete();
            }
        }
    }

    private function detachIndividualFromOrganisation($organisation_id,$individual_id)
    {
        $this->detachRolesForOrganisation($organisation_id,$individual_id);
    }

    public function getOrganisationIndividuals($id,Request $request)
    {
        $request            = json_decode(json_encode($request->query()), FALSE);
        $dataSource         = $this->helper->getDataSourceResult();

        $dataSourceSql      = str_replace(":organisation_id",$id,config('individual.grid_sql_by_organisation'));
        $dataSourceCount    = str_replace(":organisation_id",$id,config('individual.grid_sql_by_organisation_count'));

        return $dataSource->read($this->table,$this->gridColumns,$request,$dataSourceSql,$dataSourceCount);
    }

    public function getIndividualOrganisations($id,Request $request)
    {
        $request            = json_decode(json_encode($request->query()), FALSE);
        $dataSource         = $this->helper->getDataSourceResult();

        $dataSourceSql      = str_replace(":individual_id",$id,config('individual.grid_sql_organisations'));
        $dataSourceCount    = str_replace(":individual_id",$id,config('individual.grid_sql_organisations_count'));

        return $dataSource->read('vw_organisation_individuals_distinct',config('individual.grid_sql_organisation_fields'),$request,$dataSourceSql,$dataSourceCount);
    }

    public function getRoleIdsByOrganisation($organisation_id,$individual_id)
    {
        return OrganisationIndividual::where('organisation_id',$organisation_id)->where('individual_id',$individual_id)->pluck('role_id');
    }

    public function getBuildingIdsByOrganisation($organisation_id,$individual_id)
    {
        return IndividualBuilding::where('organisation_id',$organisation_id)->where('individual_id',$individual_id)->pluck('building_id');
    }

    public function unlink(UnlinkIndividualPostRequest $request)
    {
        $organisation_id    = $request->has('organisation_id') ? $request->input('organisation_id') : null;
        $individual_id      = $request->has('individual_id') ? $request->input('individual_id') : null;
        $organisation       = $this->organisation->findById($organisation_id);
        $individual         = $this->findById($individual_id);

        if (empty($organisation))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('organisation.missing')]];

        if (empty($individual))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.missing')]];

        $this->detachIndividualFromOrganisation($organisation_id,$individual_id);
        $this->detachBuildingsFromOrganisation($organisation_id,$individual_id);

        return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('individual.unlinked',['organisation'=>$organisation->name,'individual'=>$individual->first_name.' '.$individual->last_name])]];

    }

    public function link(LinkIndividualPostRequest $request)
    {
        $organisation_id    = $request->has('organisation_id') ? $request->input('organisation_id') : null;
        $id_number          = $request->has('id_number_link') ? $request->input('id_number_link') : null;
        $organisation       = $this->organisation->findById($organisation_id);
        $individual         = self::findByFieldValue('id_number',$id_number);

        if (empty($organisation))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('organisation.missing')]];

        if (empty($individual))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.id_number_not_found')]];

        $organisationHasIndividual = OrganisationIndividual::where('organisation_id',$organisation->id)->where('individual_id',$individual->id)->count();

        if ((int)$organisationHasIndividual > 0)
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.already_linked',['organisation'=>$organisation->name,'individual'=>$individual->first_name.' '.$individual->last_name])]];

        if ((int)$organisationHasIndividual === 0)
            $individual->organisations()->attach($this->mapRole([$organisation_id],config('role.claimant')));

        return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('individual.linked',['organisation'=>$organisation->name,'individual'=>$individual->first_name.' '.$individual->last_name])]];

    }

    public function updateRelations(UpdateIndividualRelationsPostRequest $request)
    {
        $success_message        = trans('individual.successfully_saved');

        $assign_roles           = null;
        $assign_buildings       = null;

        $individual_id          = $request->has('individual_id') ? $request->input('individual_id') : null;
        $individual             = Individual::findOrFail($individual_id);

        $organisation_id        = $request->has('organisation_id') ? $request->input('organisation_id') : null;
        $organisation_type_id   = $request->has('organisation_type_id') ? $request->input('organisation_type_id') : null;

        $roles                  = $request->has('roles') ? $request->input('roles') : null;
        $buildings              = $request->has('buildings') ? $request->input('buildings') : null;

        if (isset($roles))
            $assign_roles       = GeneralHelper::isArrayWithValues($roles) ? $roles : [$roles];

        if (isset($buildings))
            $assign_buildings   = GeneralHelper::isArrayWithValues($buildings) ? $buildings : [$buildings];

        if (isset($assign_buildings) && count($assign_buildings) > 0 && !in_array($organisation_type_id,config('organisation.has_buildings')))
            $assign_buildings   = [];

        if (count($assign_roles) > 0)
        {
            $this->detachRolesForOrganisation($organisation_id,$individual_id);

            foreach ($assign_roles as $role) // attach updated roles
            {
                if ((int)$role > 0)
                {
                    $map = $this->mapRole([$organisation_id],$role);
                    $individual->organisations()->attach($map);
                }
            }

            $success_message .= ', Roles Successfully Updated';
        }

        if (count($assign_buildings) > 0)
        {
            $this->detachBuildingsFromOrganisation($organisation_id,$individual_id);

            foreach ($assign_buildings as $building)
            {
                if ((int)$building > 0)
                    $individual->buildings()->attach([$building]);
            }

            $success_message .= ', Properties Successfully Updated';
        }

        return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [$success_message]];
    }

    // get all of the organisations that an individual is not linked to
    public function nonMemberOrganisations($individual_id)
    {
        return
            DB::select(
            DB::raw('SELECT id,CONCAT(name," (",organisation_type,")") AS name FROM vw_organisations
                     WHERE id 
                     NOT IN(
                     SELECT organisation_id 
                     FROM vw_organisation_individuals_distinct 
                     WHERE individual_id = :individual_id) ORDER BY name'),
            [':individual_id'=>$individual_id]);
    }

    public function linkIndividualToOrganisations(Request $request)
    {
        $individual_id = $request->has('individual_id') ? $request->input('individual_id') : null;
        $organisations = $request->has('organisations') ? $request->input('organisations') : null;

        if (empty($individual_id))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => ['individual_id expected']];

        if (empty($organisations))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.organisations_select')]];

        $individual = Individual::findOrFail($individual_id);

        if (empty($individual))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual.not_found')]];

        $assignOrganisations = GeneralHelper::isArrayWithValues($organisations) ? $organisations : [$organisations];

        foreach ($assignOrganisations as $assignOrganisation)
        {
            $individualAlreadyLinked = OrganisationIndividual::where('organisation_id',$assignOrganisation)->where('individual_id',$individual->id)->count();

            if ((int)$individualAlreadyLinked === 0)
                $individual->organisations()->attach($this->mapRole([$assignOrganisation],config('role.claimant')));
        }

        return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('individual.link_success')]];
    }
}