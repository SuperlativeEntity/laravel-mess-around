<?php

namespace App\Http\Requests;

use App\Repositories\IUserRepository as UserRepository;

class UpdateIndividualNotePostRequest extends Request
{
    public function authorize(UserRepository $user)
    {
        return $user->currentUserHasAccess('admin.individual.note.update');
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