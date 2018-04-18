<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndividualNotePostRequest;
use App\Http\Requests\UpdateIndividualNotePostRequest;
use App\Repositories\IIndividualNotesRepository as IndividualNotesRepository;
use App\Repositories\IIndividualRepository as IndividualRepository;

class IndividualNoteController extends Controller
{
    protected $individual;
    protected $note;

    public function __construct(IndividualRepository $individual,IndividualNotesRepository $note)
    {
        $this->individual   = $individual;
        $this->note         = $note;
    }

    public function getModify($id = null)
    {
        $args               = [];
        $args['individual'] = $this->individual->findById($id);

        return view('admin.individuals.notes.manage')->with($args);
    }

    public function getRecord($id = null)
    {
        return $this->note->findById($id);
    }

    public function postStore(StoreIndividualNotePostRequest $request)
    {
        return $this->note->create($request);
    }

    public function postUpdate(UpdateIndividualNotePostRequest $request)
    {
        return $this->note->update($request);
    }

    public function getList($parent_id,Request $request)
    {
        $data = $this->note->gridList($parent_id,$request);
        return response()->json($data);
    }
}