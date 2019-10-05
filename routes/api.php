<?php

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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'v1', 'namespace' => 'App\Api\V1\Controllers'], function ($api) {

        $api->group(['prefix' => 'auth', 'namespace' => 'Auth'], function ($api) {
            $api->post('/login', 'LoginController@login');
            $api->post('/refresh', 'LoginController@refresh');

            $api->post('/logout', 'LoginController@logout')->middleware('api.auth');
        });

        $api->group(['prefix' => 'users', 'middleware' => ['api.auth', 'bindings']], function ($api) {
            $api->get('/', 'UserController@index');
            $api->post('/', 'UserController@store');
            $api->get('/{user}', 'UserController@show');
            $api->patch('/{user}', 'UserController@update');
            $api->delete('/{user}', 'UserController@delete');
        });
    });
});
