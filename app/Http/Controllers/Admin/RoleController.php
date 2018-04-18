<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\IRoleRepository as RoleRepository;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    public function getList()
    {
        return response()->json($this->role->listOf());
    }

    public function getFilteredList()
    {
        return response()->json($this->role->filteredListOf(config('system.admin_roles')));
    }
}
