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

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', 'UserController@index')->name('index');

    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');

    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::post('{user}/update', 'UserController@update')->name('update');

    Route::post('{user}/delete', 'UserController@delete')->name('delete');
});
