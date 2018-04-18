<?php

namespace App\Exceptions;

use Exception;
use PDOException;
use ErrorException;
use BadMethodCallException;
use InvalidArgumentException;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

use Psr\Container\NotFoundExceptionInterface;
use Doctrine\DBAL\Driver\PDOException as DBALPDOException;
use Swift_TransportException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport =
    [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash =
    [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (env('APP_DEBUG'))
            Log::error('ExceptionHandler',['exception'=>$exception,'request'=>$request]);

        switch ($exception)
        {
            case ($exception instanceof FatalErrorException):
                return response()->view('errors.json', ['error' => trans('errors.fatal_error').': '.$exception->getMessage().' on line '.$exception->getLine().' in file '.basename($exception->getFile())], 500);
                break;

            case ($exception instanceof Swift_TransportException):
                return response()->view('errors.json', ['error' => trans('errors.error_exception').': '.$exception->getMessage().' on line '.$exception->getLine().' in file '.basename($exception->getFile())], 500);
                break;

            case ($exception instanceof ErrorException):
                return response()->view('errors.json', ['error' => trans('errors.error_exception').': '.$exception->getMessage().' on line '.$exception->getLine().' in file '.basename($exception->getFile())], 500);
                break;

            case ($exception instanceof InvalidArgumentException):
                return response()->view('errors.json', ['error' => trans('errors.error_exception').': '.$exception->getMessage().' on line '.$exception->getLine().' in file '.basename($exception->getFile())], 500);
                break;

            case ($exception instanceof BadMethodCallException):
                return response()->view('errors.json', ['error' => trans('errors.error_exception').': '.$exception->getMessage().' on line '.$exception->getLine().' in file '.basename($exception->getFile())], 500);
                break;

            case ($exception instanceof MethodNotAllowedException):
                return response()->view('errors.json', ['error' => trans('errors.method_not_allowed')], 405);
                break;

            case ($exception instanceof MethodNotAllowedHttpException):
                return response()->view('errors.json', ['error' => trans('errors.method_not_allowed')], 405);
                break;

            case ($exception instanceof NotFoundExceptionInterface):
                return response()->view('errors.custom', ['error' => trans('errors.page_not_found')], 404);
                break;

            case ($exception instanceof PDOException):

                if (str_contains(strtolower($exception->getMessage()),'no connection'))
                    return response()->view('errors.custom', ['error' => trans('errors.database_down')], 500);

                return response()->view('errors.json', ['error' => trans('errors.database_error')], 500);
                break;

            case ($exception instanceof DBALPDOException):
                return response()->view('errors.custom', ['error' => trans('errors.database_down')], 500);
                break;

            case ($exception instanceof TokenMismatchException):
                return response()->view('auth.login', ['error' => trans('login.session_expired')], 500);
                break;

            case ($exception instanceof HttpException):
                return response()->view('errors.custom', ['error' => trans('errors.maintenance_mode')], 503);
                break;

            case ($exception instanceof QueryException):
                return response()->view('errors.custom', ['error' => $exception->errorInfo[2]], 500);
                break;
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
