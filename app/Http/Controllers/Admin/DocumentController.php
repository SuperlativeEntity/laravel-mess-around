<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\ErrorHelper;
use App\Http\Requests\StoreDocumentPostRequest;
use App\Http\Requests\UpdateDocumentPostRequest;
use App\Repositories\IDocumentRepository as DocumentRepository;
use App\Repositories\IOrganisationRepository as OrganisationRepository;

class DocumentController extends Controller
{
    protected $organisation;
    protected $document;

    public function __construct(OrganisationRepository $organisation,DocumentRepository $document)
    {
        $this->organisation = $organisation;
        $this->document     = $document;
    }

    public function getModify($id = null)
    {
        $args                       = [];
        $args['organisation']       = $this->organisation->findById($id);
        $args['allowed_extensions'] = "['".implode("','",config('document.file_extensions_allowed'))."']";

        return view('admin.organisations.documents.manage')->with($args);
    }

    public function getRecord($id = null)
    {
        return $this->document->findById($id);
    }

    public function postStore(StoreDocumentPostRequest $request)
    {
        return $this->document->create($request);
    }

    public function postUpdate(UpdateDocumentPostRequest $request)
    {
        return $this->document->update($request);
    }

    public function getDownload($id)
    {
        $document   = $this->document->findById($id);
        $path       = storage_path().'/app/'.$document->storage_path;

        if (isset($document))
            return response()->download($path,$document->name);

        return ErrorHelper::failed(trans('document.download_failed'));
    }

    public function getList($parent_id,Request $request)
    {
        $data = $this->document->gridList($parent_id,$request);
        return response()->json($data);
    }
}