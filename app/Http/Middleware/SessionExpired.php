<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\IUserRepository as UserRepository;
use Illuminate\Session\Store;

class SessionExpired
{
    protected $session;
    protected $user;

    public function __construct(UserRepository $user, Store $session)
    {
        $this->user     = $user;
        $this->session  = $session;
    }

    public function handle($request, Closure $next)
    {
        if(! $this->session->has('lastActivityTime'))
        {
            $this->session->put('lastActivityTime', time());
        }
        else if((time() - $this->session->get('lastActivityTime')) > (config('system.session_expiry') * 60))
        {
            $this->session->forget('lastActivityTime');
            $this->user->logout();

            return redirect()->route('auth.login');
        }

        $this->session->put('lastActivityTime',time());
        
        return $next($request);

    }
}