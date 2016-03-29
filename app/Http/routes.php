<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/layout', function () {
    return view('layouts.master');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
});


Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('registration/step-2', [
        'uses' => 'UserController@showGotoCreateProfile',
        'as' => 'registration.step-2',
    ]);
    Route::get('profile/create', [
        'uses' => 'UserController@showCreateProfile',
        'as' => 'profile.getCreate',
    ]);
    Route::post('profile/create', [
        'uses' => 'UserController@createProfile',
        'as' => 'profile.postCreate',
    ]);
});

Route::group(['middleware' => ['web', 'authenticated']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', [
        'uses' => 'HomeController@index',
        'as' => 'home.index',
    ]);

    Route::get('/profileUpdate', ['uses' => 'UserController@showProfile']);
    Route::post('/profileUpdate', 'UserController@editProfile');
    Route::get('/codeTypes', ['uses' => 'CodeController@showCodeTypes']);
    Route::get('/codeType/{id}', ['uses' => 'CodeController@showCodesForType']);
});
