<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class LoginPostRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules =
        [
            'email'         => 'required|email|max:254',
            'password'      => 'required|max:254',
        ];

        if (env('GOOGLE_RECAPTCHA_ON_LOGIN'))
            $rules['g-recaptcha-response'] = 'required|recaptcha';

        return $rules;
    }
}