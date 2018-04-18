<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Note;
use App\Http\Requests\StoreIndividualNotePostRequest;
use App\Http\Requests\UpdateIndividualNotePostRequest;
use App\Repositories\IUserRepository as UserRepo;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;
use App\Repositories\IIndividualRepository as IndividualRepo;

class IndividualNotesRepository implements IIndividualNotesRepository
{
    protected   $helper;
    protected   $user;
    protected   $individual;
    private     $gridColumns    = [];
    private     $table          = 'notes';

    public function __construct(MySQLDatabaseHelper $helper,UserRepo $user,IndividualRepo $individual)
    {
        $this->helper       = $helper;
        $this->user         = $user;
        $this->individual   = $individual;
    }

    public function findById($id)
    {
        return Note::findOrFail($id);
    }

    public function create(StoreIndividualNotePostRequest $request)
    {
        return $this->manage($request);
    }

    public function update(UpdateIndividualNotePostRequest $request)
    {
        return $this->manage($request);
    }

    private function manage(Request $request)
    {
        $note_id        = $request->has('note_id') ? $request->input('note_id') : null;
        $linked_to      = $request->has('linked_to') ? $request->input('linked_to') : null; // e.g. individual
        $parent_model   = config('system.default_namespace').'\\'.studly_case($linked_to); // E.g. Individual
        $parent_id      = $request->has($linked_to.'_id') ? $request->input($linked_to.'_id') : null; // e.g. individual_id
        $parent         = $parent_model::findOrFail($parent_id);

        $note           = Note::findOrNew($note_id);

        if (isset($note) && isset($parent))
        {
            $note->note_type_id = (int)$request->input('note_type_id');
            $note->note         = $request->input('note');
            
            if (empty($note_id))
                $note->created_by = $this->user->get()->id;

            if (isset($note_id))
                $note->updated_by = $this->user->get()->id;

            if ($note->save())
            {
                if (empty($note_id)) // only attach if a new record is created
                    $parent->notes()->attach([$note->id]);

                return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('individual_note.successfully_saved')]];
            }
        }

        return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('individual_note.failed_to_save')]];
    }

    public function gridList($id,Request $request)
    {
        $request            = json_decode(json_encode($request->query()), FALSE);
        $dataSource         = $this->helper->getDataSourceResult();

        $dataSourceSql      = str_replace(":individual_id",$id,config('individual_note.grid_sql'));
        $dataSourceCount    = str_replace(":individual_id",$id,config('individual_note.grid_sql_count'));

        return $dataSource->read($this->table,$this->gridColumns,$request,$dataSourceSql,$dataSourceCount);
    }

}