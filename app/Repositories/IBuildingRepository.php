<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBuildingPostRequest;
use App\Http\Requests\UpdateBuildingPostRequest;

interface IBuildingRepository
{
    public function findById($id);
    public function create(StoreBuildingPostRequest $request);
    public function update(UpdateBuildingPostRequest $request);
    public function gridList($id,Request $request);
}