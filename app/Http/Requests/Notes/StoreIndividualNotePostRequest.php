<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class StoreIndividualNotePostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.individual.note.store');
    }

    public function rules()
    {
        return
        [
            'note_type_id'  => 'required|numeric',
            'note'          => 'required',
        ];
    }
}