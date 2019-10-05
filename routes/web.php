<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', 'UserController@index')->name('index');

        Route::get('/create', 'UserController@create')->name('create');
        Route::post('/store', 'UserController@store')->name('store');

        Route::get('{user}/edit', 'UserController@edit')->name('edit');
        Route::post('{user}/update', 'UserController@update')->name('update');

        Route::post('{user}/delete', 'UserController@delete')->name('delete');
    });

    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::get('/', 'PostController@index')->name('index');

        Route::get('/create', 'PostController@create')->name('create');
        Route::post('/store', 'PostController@store')->name('store');

        Route::get('{post}/edit', 'PostController@edit')->name('edit');
        Route::post('{post}/update', 'PostController@update')->name('update');

        Route::post('{post}/delete', 'PostController@delete')->name('delete');
    });
});
