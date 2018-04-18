<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Traits\IndividualTrait;
use App\Repositories\IUserRepository as UserRepo;
use App\Repositories\IIndividualRepository as IndividualRepo;
use App\Repositories\IRoleRepository as RoleRepo;

class IndividualComposer
{
    use IndividualTrait;

    protected $individual;
    protected $user;
    protected $role;

    public function __construct(UserRepo $user,RoleRepo $role,IndividualRepo $individual)
    {
        $this->individual   = $individual;
        $this->user         = $user;
        $this->role         = $role;
    }

    public function compose(View $view)
    {
        $this->apply();

        if (isset($this->loggedInIndividual->id))
            session(['individual_id' => $this->loggedInIndividual->id]);

        if (isset($this->organisationIds) && count($this->organisationIds) > 0)
            session(['individual_organisation_ids' => $this->organisationIds]);

        $view->with([]);

        /*

        if ($this->hasAdminRole)
            $view->with([]);

        if (isset($this->loggedInUser))
        {
            $view->with
            ([
                'individual_record'  => $this->loggedInIndividual,
            ]);
        }*/
    }
}