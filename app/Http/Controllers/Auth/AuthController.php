<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Socialize;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Repositories\IUserRepository as UserRepository;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    // auth/login
    public function getLogin()
    {
        return view('auth.login');
    }

    // auth/credentials
    public function postCredentials(LoginPostRequest $request)
    {
        $response = $this->user->authenticate($request);

        return response()->json($response['errors'],$response['code']);
    }

    // auth/logout
    public function getLogout()
    {
        $this->user->logout();
        return redirect()->route('auth.login');
    }

    public function redirectToProvider()
    {
        return Socialize::with('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user       = Socialize::with('facebook')->user();
        $email      = Str::lower($user->email);
        $foundUser  = null;

        // if the social account was found
        if (isset($user))
        {
            // check if the user already exists
            $foundUser  = $this->user->findByEmail($email);
            $parts      = explode(" ", $user->name);

            // if not, create and activate
            if ($foundUser == null)
                $foundUser = $this->user->providerCreate($parts[0],array_pop($parts),$email,str_random(10));

            // log the user in
            $this->user->login($foundUser);

            // redirect to dashboard
            return redirect()->route('index');

        }

        // otherwise, redirect back to log in screen
        return redirect()->route('auth.login');
    }
}