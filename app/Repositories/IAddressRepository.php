<?php

namespace App\Repositories;

use App\Http\Requests\ManageAddressPostRequest;

interface IAddressRepository
{
    public function manage(ManageAddressPostRequest $request);
    public function get($args);
}