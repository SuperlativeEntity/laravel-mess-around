<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\StoreUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use App\Http\Requests\AssignUserRolePostRequest;

interface IUserRepository
{
    public function check();
    public function get();
    public function findById($id);
    public function findByEmail($email);
    public function create(StoreUserPostRequest $request);
    public function providerCreate($firstName,$lastName,$email,$password);
    public function attachUserToRole($user,$role);
    public function update(UpdateUserPostRequest $request);
    public function login($user);
    public function logout();
    public function authenticate(LoginPostRequest $request);
    public function gridList(Request $request);
    public function assignRoles(AssignUserRolePostRequest $request);
    public function currentUserHasAccess($permission);
    public function detachAllUserRoles($userId);
}