<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIndividualNotePostRequest;
use App\Http\Requests\UpdateIndividualNotePostRequest;

interface IIndividualNotesRepository
{
    public function findById($id);
    public function create(StoreIndividualNotePostRequest $request);
    public function update(UpdateIndividualNotePostRequest $request);
    public function gridList($id,Request $request);
}