<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Individual;
use App\Http\Requests\StoreIndividualPostRequest;
use App\Http\Requests\UpdateIndividualPostRequest;

interface IIndividualRepository
{
    public function findById($id);
    public function findByFieldValue($field,$value);
    public function organisations($id);
    public function organisationIds($id);
    public function setValues(Request $request,Individual $individual,$individual_id);
    public function create(StoreIndividualPostRequest $request);
    public function update(UpdateIndividualPostRequest $request);
    public function gridList(Request $request);
    public function createAccount(Request $request);
}