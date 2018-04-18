<?php

namespace App\Repositories;

use DB;
use Illuminate\Http\Request;

use App\Organisation;

use App\Http\Requests\StoreOrganisationPostRequest;
use App\Http\Requests\UpdateOrganisationPostRequest;

use App\Repositories\IUserRepository as UserRepo;
use App\Repositories\IIndividualRepository as IndividualRepo;

use App\Helpers\GeneralHelper;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;

class OrganisationRepository implements IOrganisationRepository
{
    protected $helper;
    protected $individual;
    protected $individualLoggedIn;
    protected $user;
    protected $role;
    protected $userId;

    private $table  = 'organisations';

    public function __construct(MySQLDatabaseHelper $helper,UserRepo $user,IndividualRepo $individual)
    {
        $this->helper               = $helper;
        $this->individual           = $individual;
        $this->user                 = $user;
    }

    public function findById($id)
    {
        return Organisation::findOrFail($id);
    }

    public function create(StoreOrganisationPostRequest $request)
    {
        return $this->manage($request);
    }

    public function update(UpdateOrganisationPostRequest $request)
    {
        return $this->manage($request);
    }

    public function manage(Request $request)
    {
        $organisation_id    = $request->has('id') ? (int)$request->input('id') : null;
        $parent_id          = $request->has('organisation_id') ? (int)$request->input('organisation_id') : null;

        if (isset($parent_id) && isset($organisation_id) && $organisation_id === $parent_id)
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('organisation.circular_reference')]];

        $organisation      = Organisation::findOrNew($organisation_id);
        $parent            = (isset($parent_id) && (int)$parent_id > 0) ? Organisation::findOrFail($parent_id) : null;

        // if the organisation selected already has a parent
        if (isset($parent) && $parent->parent->count() > 0)
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('organisation.already_has_parent')]];

        $organisation->organisation_type_id = $request->input('organisation_type_id');
        $organisation->name                 = $request->input('name');
        $organisation->registration_number  = $request->input('registration_number');
        $organisation->phone                = ($request->has('phone') && $request->input('phone') != '') ? $request->input('phone') : null;
        $organisation->email                = ($request->has('email') && $request->input('email') != '') ? $request->input('email') : null;
        $organisation->deed                 = ($request->has('deed') && $request->input('deed') != '') ? $request->input('deed') : null;

        // unlink claim from parent claim
        if (isset($organisation->parent) && empty($parent_id))
            $organisation->parent()->detach(); // detach current parent

        if (empty($organisation_id))
        {
            $organisation->created_by       = $this->user->get()->id;

            if ($organisation->save())
            {
                // reload with edit view
                $response                   = ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('organisation.successfully_created')]];
                $response['id']             = $organisation->id;
                $response['redirect_url']   = route('admin.organisation.modify');

                return $response;
            }

            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('organisation.failed_to_create')]];
        }

        if (isset($organisation_id) && (int)$organisation_id > 0)
        {
            $organisation->updated_by = $this->user->get()->id;

            if ($organisation->save())
            {
                $currentParent   = (count($organisation->parent) > 0) ? $organisation->parent->first() : null;
                $currentParentId = (count($organisation->parent) > 0) ? (int)$currentParent->id : null;

                // only update parent if it changed
                if (isset($parent) && $parent->id !== $currentParentId)
                {
                    $organisation->parent()->detach(); // detach current parent
                    $parent->child()->attach([$organisation->id]); // attach to new parent
                }

                return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('organisation.successfully_updated')]];
            }
        }
        
        return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('organisation.failed_to_update')]];
    }

    public function gridList(Request $request)
    {
        $dataSource = $this->helper->getDataSourceResult();
        $request    = json_decode(json_encode($request->query()), FALSE);
        $sql        = config('organisation.grid_sql');

        if (GeneralHelper::isArrayWithValues(session('individual_organisation_ids')))
            $sql .= ' WHERE id IN('.implode(',',session('individual_organisation_ids')).')';

        return $dataSource->read($this->table,config('organisation.grid_columns'),$request,$sql);
    }

    public function valueExists($field,$value)
    {
        $count = Organisation::where($field,'=',$value)->count();

        return ($count > 0) ? true : false;
    }

    public function parents($id)
    {
        $parents = [];
        $this->findParents($parents,Organisation::findOrFail($id));
        return $parents;
    }

    public function children($id)
    {
        $children = [];
        $this->findChildren($children,Organisation::findOrFail($id));
        return $children;
    }

    public function hierarchy($id)
    {
        return array_merge($this->parents($id),[Organisation::findOrFail($id)],$this->children($id));
    }

    public function orphans()
    {
        return DB::select(DB::raw('select * from organisations where id NOT IN (SELECT DISTINCT parent_id FROM organisation_relations) AND id NOT IN(SELECT DISTINCT child_id FROM organisation_relations)'));
    }

    public function recent($take = 5)
    {
        return Organisation::take((int)$take)->orderBy('created_at','desc')->get();
    }

    private function findChildren(&$data,Organisation $organisation)
    {
        if ($organisation->child->count() === 0)
            return $data;

        if ($organisation->child->count() > 0)
        {
            foreach ($organisation->child as $child)
            {
                array_push($data,$child);
                $this->findChildren($data,$child);
            }
        }
    }

    public function findParents(&$data,Organisation $organisation)
    {
        if ($organisation->parent->count() === 0)
            return $data;

        if ($organisation->parent->count() > 0)
        {
            foreach ($organisation->parent as $parent)
            {
                array_push($data,$parent);
                $this->findParents($data,$parent);
            }
        }
    }

}