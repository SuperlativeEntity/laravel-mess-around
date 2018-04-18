<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrganisationPostRequest;
use App\Http\Requests\UpdateOrganisationPostRequest;

interface IOrganisationRepository
{
    public function findById($id);
    public function create(StoreOrganisationPostRequest $request);
    public function update(UpdateOrganisationPostRequest $request);
    public function manage(Request $request);
    public function gridList(Request $request);
    public function valueExists($field,$value);
    public function parents($id);
    public function children($id);
    public function hierarchy($id);
    public function orphans();
    public function recent($take);
}