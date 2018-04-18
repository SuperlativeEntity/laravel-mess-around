<?php

namespace App\Repositories;

use App\Helpers\CacheHelper;

class DropDownRepository implements IDropDownRepository
{

    public function listOf($model)
    {
        $formatModel    = studly_case($model); // AddressType or address_type will work
        $modelName      = config('system.default_namespace').'\\'.$formatModel;

        if (!in_array($formatModel,config('system.drop_downs_allowed')))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('errors.restricted_data')]];

        if (!class_exists($modelName))
            return ['success' => false, 'code' => config('http_code.internal_server_error'), 'messages' => [trans('errors.class_missing')]];

        $data = CacheHelper::dropDownCache($modelName);

        return $data;
    }
}