<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\IDropDownRepository as DropDownRepository;

class DropDownController extends Controller
{
    protected $drop_down;

    public function __construct(DropDownRepository $drop_down)
    {
        $this->drop_down = $drop_down;
    }

    // e.g. public/admin/drop-down/list/paymentmethod
    // usage: route('admin.drop_down.list',['name' => 'paymentmethod'])
    public function getList($name)
    {
        $data = $this->drop_down->listOf($name);

        return response()->json($data,isset($data['code']) ? $data['code'] : config('http_code.ok'));
    }
}
