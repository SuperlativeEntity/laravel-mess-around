<?php

namespace App\Http\Requests\Password;

use App\Http\Requests\Request;

class ChangePasswordPostRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
        [
            'token'     => 'required',
            'email'     => 'required|email|max:254',
            'password'  => 'required|confirmed|case_diff|numbers|letters|symbols|min:8|max:254',
        ];
    }
}
