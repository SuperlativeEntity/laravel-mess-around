<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentPostRequest;
use App\Http\Requests\UpdateDocumentPostRequest;

interface IDocumentRepository
{
    public function findById($id);
    public function create(StoreDocumentPostRequest $request);
    public function update(UpdateDocumentPostRequest $request);
    public function gridList($id,Request $request);
}