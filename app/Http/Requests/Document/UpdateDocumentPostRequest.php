<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateDocumentPostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.organisation.document.update');
    }

    public function rules()
    {
        return
        [
            'document_type_id'      => 'required|numeric',
        ];
    }
}