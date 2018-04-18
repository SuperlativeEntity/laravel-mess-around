<?php namespace App\Adapters;

use Exception;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\UserInterface;
use Tymon\JWTAuth\Providers\Auth\AuthInterface;

use App\Events\User\Authenticated;
use App\Helpers\MySQLDatabaseHelper;
use App\Repositories\ActivityRepository;
use App\Repositories\UserRepository;

// used by JSON Web Tokens package

class SentinelAuthAdapter implements AuthInterface
{
    public function byCredentials(array $credentials = [])
    {
        try
        {
            $user = Sentinel::authenticate($credentials);

            event(new Authenticated(new ActivityRepository(),new UserRepository(new MySQLDatabaseHelper())));

            return $user instanceof UserInterface;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    public function byId($id)
    {
        try
        {
            $user = Sentinel::findById($id);
            Sentinel::login($user);

            return $user instanceof UserInterface && Sentinel::check();
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    public function user()
    {
        return Sentinel::getUser();
    }
}