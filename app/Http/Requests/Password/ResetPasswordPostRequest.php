<?php

namespace App\Http\Requests\Password;

use App\Http\Requests\Request;

class ResetPasswordPostRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
        [
            'email' => 'required|email|max:254',
        ];
    }
}
