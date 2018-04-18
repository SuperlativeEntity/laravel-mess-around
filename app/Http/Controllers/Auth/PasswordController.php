<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\ResetPasswordPostRequest;
use App\Http\Requests\Password\ChangePasswordPostRequest;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class PasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
    }

    public function getReset($token = null)
    {
        return view('auth.reset')->with('token', $token);
    }

    public function postEmail(ResetPasswordPostRequest $request)
    {
        $response = null;

        $result = Password::sendResetLink($request->only('email'), function (Message $message)
        {
            $message->subject($this->getEmailSubject());
        });

        switch ($result)
        {
            case Password::RESET_LINK_SENT:
                return response()->json(['messages'=>[trans($result)]],config('http_code.ok'));
                break;
            case Password::INVALID_USER:
                return response()->json(['errors'=>[trans($result)]],config('http_code.unprocessable_entity'));
        }

    }

    public function postReset(ChangePasswordPostRequest $request)
    {
        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        $response = Password::reset($credentials, function ($user, $password)
        {
            $this->resetPassword($user,$password);
        });

        switch ($response)
        {
            case Password::PASSWORD_RESET:
                return response()->json(['messages'=>[trans($response)]],config('http_code.ok'));
                break;
            case Password::INVALID_TOKEN:
                return response()->json(['errors'=>[trans($response)]],config('http_code.unprocessable_entity'));
                break;
            case Password::INVALID_USER:
                return response()->json(['errors'=>[trans($response)]],config('http_code.unprocessable_entity'));
        }
    }
}
