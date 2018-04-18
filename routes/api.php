<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if (config('system.enable_api') === true)
{
    Route::group(['middleware' => 'api', 'prefix' => 'api/v1'], function ()
    {
        Route::post('authenticate', 'TokenController@authenticate');
        Route::get('authenticate/refresh', 'TokenController@refreshToken');

        // http://<site>/public/api/v1/admin/users/update
        Route::group(['middleware' => 'jwt.auth','prefix' => 'admin/users'], function ()
        {
            Route::get('authenticated/user', 'TokenController@getAuthenticatedUser');
            Route::get('list', 'Admin\UserController@getList');
            Route::get('get/{id?}', 'Admin\UserController@get');
            Route::post('store', 'Admin\UserController@postStore');
            Route::post('update', 'Admin\UserController@postUpdate');
        });

    });
}