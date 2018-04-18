<?php

namespace App\Repositories;

use DB;
use App\Address;
use Illuminate\Http\Request;
use App\Http\Requests\ManageAddressPostRequest;
use App\Repositories\IUserRepository as UserRepo;

class AddressRepository implements IAddressRepository
{
    protected $table = 'addresses';

    private     $linked_to;
    private     $parent_id;
    protected   $user;

    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }

    // the idea is to be able to link addresses to members or companies etc.
    public function manage(ManageAddressPostRequest $request)
    {
        $response               = [];

        $linked_to              = $request->has('linked_to') ? $request->input('linked_to') : null; // e.g. member
        $parent_model           = config('system.default_namespace').'\\'.studly_case($linked_to); // E.g. Member
        $link_table             = $request->has('link_to') ? $linked_to.'_'.$this->table : null; // e.g. member_addresses
        $parent_id              = $request->has($linked_to.'_id') ? $request->input($linked_to.'_id') : null; // e.g. member_id
        $parent                 = $parent_model::findOrFail($parent_id);

        $this->linked_to        = $linked_to;
        $this->parent_id        = $parent_id;

        if ($parent == null)
            $response = ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('address.address_parent_missing')]];

        $physical_address       = $this->get(['linked_to' => $linked_to,'linked_to' => $linked_to,'parent_id' => $parent_id,'address_type_id' => config('address.physical_address')]);
        $postal_address         = $this->get(['linked_to' => $linked_to,'parent_id' => $parent_id,'address_type_id' => config('address.postal_address')]);

        $physical_address_id    = isset($physical_address->id) ? $physical_address->id : null;
        $postal_address_id      = isset($postal_address->id) ? $postal_address->id : null;

        $physical_address       = $this->model($physical_address_id,'physical',$request,config('address.address_fields'));
        $postal_address         = $this->model($postal_address_id,'postal',$request,config('address.address_fields'));

        if (empty($physical_address_id) && empty($postal_address_id))
            $parent->addresses()->attach([$physical_address->id,$postal_address->id]);

        $response               = ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('address.address_saved_success')]];

        return $response;
    }

    public function get($args)
    {
        $return_type    = isset($args['return_type']) ? $args['return_type'] : 'single'; // single / multiple
        $linked_to      = isset($args['linked_to']) ? $args['linked_to'] : null;

        $query = DB::table($this->table);

        $query->select('addresses.*',$linked_to.'_addresses.'.$linked_to.'_id');
        $query->join($linked_to.'_addresses', $linked_to.'_addresses.address_id', '=', 'addresses.id');
        $query->where($linked_to.'_addresses.'.$linked_to.'_id','=',$args['parent_id']);
        $query->whereNull($linked_to.'_addresses.deleted_at');

        if (isset($args['address_type_id']))
            $query->where('addresses.address_type_id','=',$args['address_type_id']);

        return ($return_type == 'multiple') ? $query->get() : $query->first();
    }
    
    private function model($id = null,$addressType,Request $request,$fields)
    {
        $address                    = Address::findOrNew($id);
        $address->address_type_id   = config('address.'.$addressType.'_address');

        foreach ($fields as $field)
        {
            $fieldName = $addressType.'_'.$field;
            $address->$field  = $request->has($fieldName) ? $request->input($fieldName) : null;
        }

        $address->unique_key = $this->linked_to.'_'.$this->parent_id.'_'.$address->address_type_id;

        if (empty($id))
            $address->created_by = $this->user->get()->id;

        if (isset($id))
            $address->updated_by = $this->user->get()->id;

        $address->save();

        return $address;
    }
}