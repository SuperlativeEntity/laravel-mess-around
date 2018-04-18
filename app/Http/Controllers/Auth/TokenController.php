<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions;

class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate','refreshToken']]);
    }

    public function refreshToken()
    {
        $current_token  = JWTAuth::getToken();
        $token          = JWTAuth::refresh($current_token);

        return response()->json(compact('token'));
    }

    public function authenticate(LoginPostRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try
        {
            if (! $token = JWTAuth::attempt($credentials))
            {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }
        catch (JWTException $e)
        {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try
        {
            if (! $user = JWTAuth::parseToken()->authenticate())
            {
                return response()->json(['user_not_found'], 404);
            }
        }
        catch (Exceptions\TokenExpiredException $e)
        {
            return response()->json(['token_expired'], $e->getStatusCode());
        }
        catch (Exceptions\TokenInvalidException $e)
        {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }
        catch (Exceptions\JWTException $e)
        {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}