<?php

namespace App\Traits;

// repositories are made available from parent class

trait IndividualTrait
{
    public $loggedInUser;
    public $loggedInIndividual;

    public $hasAdminRole;
    public $hasMemberRole;

    public $organisationIds;

    public function apply()
    {
        $userLoggedIn = $this->user->get();

        if (isset($userLoggedIn))
        {
            $this->loggedInUser     = $userLoggedIn;
            $this->hasAdminRole     = $this->role->hasRole('admin');
            $this->hasMemberRole    = $this->role->hasRole('member');

            if (isset($this->loggedInUser))
                $this->loggedInIndividual = $this->individual->findByFieldValue('user_id',$this->loggedInUser->id);

            if (isset($this->loggedInIndividual))
                $this->organisationIds = $this->individual->organisationIds($this->loggedInIndividual->id);
        }
    }
}