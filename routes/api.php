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

            $api->post('/refresh', 'LoginController@refresh')->middleware('api.auth');
            $api->post('/logout', 'LoginController@logout')->middleware('api.auth');
        });

        $api->group(['prefix' => 'users', 'middleware' => ['api.auth', 'bindings']], function ($api) {
            $api->get('/', 'UserController@index');
            $api->post('/', 'UserController@store');
            $api->get('/{user}', 'UserController@show');
            $api->post('/{user}/update', 'UserController@update');
            $api->post('/{user}/delete', 'UserController@delete');

            $api->group(['prefix' => '{user}/posts'], function ($api) {
                $api->get('/', 'PostController@index');
                $api->post('/', 'PostController@store');
                $api->get('/{post}', 'PostController@show');
                $api->post('/{post}/update', 'PostController@update');
                $api->post('/{post}/delete', 'PostController@delete');
            });
        });
    });
});
