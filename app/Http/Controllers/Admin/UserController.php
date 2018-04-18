<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use App\Http\Requests\AssignUserRolePostRequest;
use App\Repositories\IUserRepository as UserRepository;
use App\Repositories\IRoleRepository as RoleRepository;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(UserRepository $user,RoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function getCreate()
    {
        return view('admin.users.create');
    }

    public function getModify($id = null)
    {
        $args = null;

        if (isset($id))
            $args['user'] = $this->user->findById($id);
        
        $roles = $this->role->getUserRoles($id);

        if (count($roles) > 0)
            $args['user_roles'] = $roles;

        return view('admin.users.modify')->with($args);
    }

    public function getIndex()
    {
        return view('admin.users.index');
    }

    public function getIndexHtml()
    {
        return view('admin.users.index_html');
    }

    public function postStore(StoreUserPostRequest $request)
    {
        return $this->user->create($request);
    }

    public function postUpdate(UpdateUserPostRequest $request)
    {
        return $this->user->update($request);
    }

    public function getList(Request $request)
    {
        $data = $this->user->gridList($request);
        return response()->json($data);
    }

    public function postAssignRoles(AssignUserRolePostRequest $request)
    {
        $data = $this->user->assignRoles($request);
        return response($data, $data['code']);
    }

    public function get($id)
    {
        $user = $this->user->findById((int)$id);

        if ($user == null)
            return response()->json(['error' => 'user_not_found'],422);

        return response()->json($user);
    }
}
