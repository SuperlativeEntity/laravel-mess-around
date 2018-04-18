<?php

namespace App\Http\Middleware;

use App\Repositories\IndividualRepository;
use App\Repositories\UserRepository;
use Closure;

class IndividualCheck
{
    protected $user;
    protected $individual;

    public function __construct(IndividualRepository $individual,UserRepository $user)
    {
        $this->user         = $user;
        $this->individual   = $individual;
    }

    public function handle($request, Closure $next)
    {
        $sessionIndividualId = (int)session('individual_id');

        if ($sessionIndividualId > 0)
        {
            // get the individual record linked to the user logged in
            $individualLoggedIn = $this->individual->findByFieldValue('user_id',$this->user->get()->id);

            if (isset($individualLoggedIn) && (int)$individualLoggedIn->id !== $sessionIndividualId)
                return response()->view('errors.json', ['error' => 'User Account does not match Individual Record'], 401);
        }

        return $next($request);
    }
}