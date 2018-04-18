<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndividualPostRequest;
use App\Http\Requests\UpdateIndividualPostRequest;

use App\Repositories\IIndividualRepository as IndividualRepository;

class IndividualController extends Controller
{
    protected $individual;

    public function __construct(IndividualRepository $individual)
    {
        $this->individual   = $individual;
    }

    public function getIndex()
    {
        return view('admin.individuals.index');
    }

    public function getIndexHtml()
    {
        return view('admin.individuals.index_html');
    }

    public function getCreate()
    {
        $args = [];

        return view('admin.individuals.create')->with($args);
    }

    public function getModify($id = null)
    {
        $args               = [];
        $args['individual'] = $this->individual->findById($id);

        return view('admin.individuals.modify')->with($args);
    }

    public function getRelations($id = null)
    {
        $args               = [];
        $args['individual'] = $this->individual->findById($id);

        return view('admin.individuals.relations')->with($args);
    }

    public function postStore(StoreIndividualPostRequest $request)
    {
        return $this->individual->create($request);
    }

    public function postUpdate(UpdateIndividualPostRequest $request)
    {
        return $this->individual->update($request);
    }

    public function getList(Request $request)
    {
        $data = $this->individual->gridList($request);
        return response()->json($data);
    }

    public function createAccount(Request $request)
    {
        $response = $this->individual->createAccount($request);

        return response()->json(((int)$response['code'] !== config('http_code.ok')) ? $response['messages'] : $response,$response['code']);
    }
}