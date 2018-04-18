<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\StoreUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use App\Http\Requests\AssignUserRolePostRequest;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

use App\Events\User\Authenticated;
use App\Events\User\Logout;

use App\Helpers\GeneralHelper;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;

use PDOException,Session;

class UserRepository implements IUserRepository
{
    protected   $helper;
    private     $table       = 'users';
    private     $gridColumns = ['id','first_name','last_name','email'];

    public function __construct(MySQLDatabaseHelper $helper)
    {
        $this->helper = $helper;
    }

    public function check()
    {
        return Sentinel::check();
    }

    public function get()
    {
        return Sentinel::getUser();
    }

    public function findById($id)
    {
        return Sentinel::findById($id);
    }

    public function findByEmail($email)
    {
        return Sentinel::findByCredentials(['login' => $email]);
    }

    public function login($user)
    {
        return Sentinel::login($user);
    }

    public function logout()
    {
        event(new Logout(new ActivityRepository(),new UserRepository($this->helper)));
        Sentinel::logout();
        Session::flush();
    }

    public function create(StoreUserPostRequest $request)
    {
        $response   = [];
        $user       = $this->providerCreate($request->input('first_name'),$request->input('last_name'),$request->input('email'),$request->input('password'));

        if (isset($user))
        {
            $response['success']        = true;
            $response['code']           = config('http_code.ok');
            $response['messages']       = [trans('user.user_create_success')];
            $response['id']             = $user->id;
            $response['redirect_url']   = route('admin.user.modify');

            return $response;
        }

        $response['success']    = false;
        $response['code']       = config('http_code.unprocessable_entity');
        $response['errors']     = [trans('user.user_create_failed')];

        return $response;
    }

    public function providerCreate($firstName,$lastName,$email,$password)
    {
        $user = null;

        // create user
        $user = Sentinel::create
        ([
            'first_name'    => $firstName,
            'last_name'     => $lastName,
            'email'         => Str::lower($email),
            'password'      => $password,
        ]);

        if ($user)
        {
            // create activation code for user
            $activation = Activation::create($user);

            // complete user activation
            Activation::complete($user, $activation->code);
        }

        return $user;
    }

    public function attachUserToRole($user,$role)
    {
        $role = Sentinel::findRoleById($role);
        $role->users()->attach($user);
    }

    public function update(UpdateUserPostRequest $request)
    {
        $response   = [];
        $user       = self::findById($request->input('id'));

        if (isset($user))
        {
            $credentials =
            [
                'email'         => Str::lower($request->input('email')),
                'first_name'    => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
            ];

            $password = $request->input('password');

            if ($request->has('password') && strlen($password) >= config('system.min_password_length'))
                $credentials['password'] = $request->input('password');

            if (Sentinel::update($user, $credentials))
            {
                $response['success']    = true;
                $response['code']       = config('http_code.ok');
                $response['messages']   = [trans('user.user_update_success')];
            }
            else
            {
                $response['success']    = false;
                $response['code']       = config('http_code.unprocessable_entity');
                $response['errors']     = [trans('user.user_update_failed')];
            }
        }

        return $response;
    }

    public function authenticate(LoginPostRequest $request)
    {
        $authenticated  = false;
        $response       = [];

        $email          = $request->input('email');
        $password       = $request->input('password');
        //$remember       = ($request->has('remember') && $request->input('remember') == 'on') ? true : false;

        $check          = Sentinel::findByCredentials(['login' => $email]);

        if ($check == null)
        {
            $response['code']   = config('http_code.unprocessable_entity');
            $response['errors'] = [trans('login.not_found')];
            return $response;
        }

        $credentials =
        [
            'email'     => $email,
            'password'  => $password
        ];

        try
        {
            // persistence seems more stable when defaulting remember to true
            $authenticated = Sentinel::authenticate($credentials,config('system.persist_user'));

            if ($authenticated)
            {
                $response['success'] = true;
                $response['code']    = config('http_code.ok');
                $response['errors']  = [null];

                event(new Authenticated(new ActivityRepository(),new UserRepository($this->helper)));
            }
        }
        catch (NotActivatedException $e)
        {
            $response['success']    = false;
            $response['code']       = config('http_code.unprocessable_entity');
            $response['errors']     = [trans('login.not_activated')];
            return $response;
        }
        catch (ThrottlingException $e)
        {
            $response['success']    = false;
            $response['code']       = config('http_code.unprocessable_entity');
            $response['errors']     = [trans('login.attempts')];
            return $response;
        }

        if (!$authenticated)
        {
            $response['success']    = false;
            $response['code']       = config('http_code.unprocessable_entity');
            $response['errors']     = [trans('login.auth_failed')];
        }

        return $response;
    }

    public function gridList(Request $request)
    {
        $request    = json_decode(json_encode($request->query()), FALSE);
        $dataSource = $this->helper->getDataSourceResult();
        return $dataSource->read($this->table,$this->gridColumns,$request);
    }

    public function assignRoles(AssignUserRolePostRequest $request)
    {
        $response  = [];

        $user           = self::findById($request->input('user_id'));
        $input_roles    = $request->input('roles');
        $roles          = GeneralHelper::isArrayWithValues($input_roles) ? $input_roles : [$input_roles];

        if (isset($user) && count($roles) > 0)
        {
            self::detachAllUserRoles($user->id);

            foreach ($roles as $assign_role)
            {
                $role = Sentinel::findRoleById($assign_role);

                try
                {
                    $role->users()->attach($user);
                }
                catch (PDOException $err)
                {
                    $response['success']    = false;
                    $response['code']       = config('http_code.unprocessable_entity');
                    $response['errors']     = [trans('role.roles_assigned_error')];
                    return $response;
                }
            }

            $response['success']    = true;
            $response['code']       = config('http_code.ok');
            $response['messages']   = [trans('role.roles_assigned')];
        }

        return $response;
    }

    public function currentUserHasAccess($permission)
    {
        $user = self::get();
        return $user->hasAccess([$permission]);
    }

    public function detachAllUserRoles($userId)
    {
        $user   = self::findById($userId);
        $roles  = $user->roles()->get();

        if (count($roles) > 0 && isset($user))
        {
            foreach ($roles as $role)
            {
                $role->users()->detach($user);
            }
        }
    }
}