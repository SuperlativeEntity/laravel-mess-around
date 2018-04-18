<?php

namespace App\Repositories;

use App\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;

class RoleRepository implements IRoleRepository
{
    protected $table = 'roles';

    public function listOf()
    {
        return Role::all();
    }

    public function filteredListOf($excludeRoles)
    {
        return  DB::table($this->table)->select('id','name')->whereNotIn('id',$excludeRoles)->get();
    }

    public function getUserRoles($userId)
    {
        return Sentinel::findById($userId)->roles()->get();
    }

    public function hasRole($slug)
    {
        return Sentinel::inRole($slug);
    }
}