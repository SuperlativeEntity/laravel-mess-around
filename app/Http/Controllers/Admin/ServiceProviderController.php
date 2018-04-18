<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\IOrganisationRepository as OrganisationRepository;

class ServiceProviderController extends Controller
{
    protected $organisation;
    protected $individual;

    public function __construct(OrganisationRepository $organisation)
    {
        $this->organisation = $organisation;
    }

    public function getModify($id = null)
    {
        $args                           = [];
        $args['organisation']           = $this->organisation->findById($id);
        $args['service_providers']      = $args['organisation']->individuals(config('role.service_provider'))->get();

        return view('admin.organisations.service_providers.list')->with($args);
    }
}