<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Document;
use App\Http\Requests\StoreDocumentPostRequest;
use App\Http\Requests\UpdateDocumentPostRequest;
use App\Repositories\IUserRepository as UserRepo;
use App\Helpers\IDatabaseHelper as MySQLDatabaseHelper;
use App\Repositories\IOrganisationRepository as OrganisationRepo;

class DocumentRepository implements IDocumentRepository
{
    protected   $helper;
    protected   $user;
    protected   $organisation;
    private     $gridColumns    = [];
    private     $table          = 'documents';

    public function __construct(MySQLDatabaseHelper $helper,UserRepo $user,OrganisationRepo $organisation)
    {
        $this->helper       = $helper;
        $this->user         = $user;
        $this->organisation = $organisation;
    }

    public function findById($id)
    {
        return Document::findOrFail($id);
    }

    public function create(StoreDocumentPostRequest $request)
    {
        return $this->manage($request);
    }

    public function update(UpdateDocumentPostRequest $request)
    {
        return $this->manage($request);
    }

    private function manage(Request $request)
    {
        $document_id            = $request->has('document_id') ? $request->input('document_id') : null;
        $linked_to              = $request->has('linked_to') ? $request->input('linked_to') : null; // e.g. organisation
        $parent_model           = config('system.default_namespace').'\\'.studly_case($linked_to); // E.g. Organisation
        $parent_id              = $request->has($linked_to.'_id') ? $request->input($linked_to.'_id') : null; // e.g. organisation_id
        $parent                 = $parent_model::findOrFail($parent_id);

        if ($request->hasFile('document_selected') && $request->file('document_selected')->isValid())
        {
            $file       = $request->document_selected;
            $path       = $file->store('documents');
            $document   = Document::findOrNew($document_id);

            if (isset($document) && isset($parent))
            {
                $document->document_type_id     = $request->input('document_type_id');
                $document->name                 = $file->getClientOriginalName();
                $document->size                 = number_format($file->getSize() / 1024,2);
                $document->mime_type            = $file->getMimeType();
                $document->extension            = $file->extension();
                $document->storage_path         = $path;

                if (empty($document_id))
                    $document->created_by = $this->user->get()->id;

                if (isset($document_id))
                    $document->updated_by = $this->user->get()->id;

                if ($document->save())
                {
                    if (empty($document_id)) // only attach if a new record is created
                        $parent->documents()->attach([$document->id]);

                    return ['success' => true, 'code' => config('http_code.ok'), 'messages' => [trans('document.successfully_saved')]];
                }
            }
        }

        return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('document.failed_to_save')]];
    }

    public function gridList($id,Request $request)
    {
        $request            = json_decode(json_encode($request->query()), FALSE);
        $dataSource         = $this->helper->getDataSourceResult();

        $dataSourceSql      = str_replace(":organisation_id",$id,config('document.grid_sql'));
        $dataSourceCount    = str_replace(":organisation_id",$id,config('document.grid_sql_count'));

        return $dataSource->read($this->table,$this->gridColumns,$request,$dataSourceSql,$dataSourceCount);
    }

}