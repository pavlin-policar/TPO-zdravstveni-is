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

    Route::get('register/verify/{confirmationCode}', [
        'as' => 'confirmation_path',
        'uses' => 'AuthController@confirm'
    ]);
});

/**
 * Routes that only authenticated users can access, but they needn't have completed the registration
 * process.
 */
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

    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'home.index',
    ]);

    Route::get('/profile/{user?}', [
        'uses' => 'UserController@showProfile',
        'as' => 'profile.show'
    ]);

    Route::put('profile/{user}/update', [
        'uses' => 'UserController@updatePersonalInfo',
        'as' => 'profile.updatePersonal',
    ]);

    Route::put('profile/{user}/password', [
        'uses' => 'UserController@changePassword',
        'as' => 'profile.changePassword',
    ]);

    Route::get('/profileUpdate', ['uses' => 'UserController@showProfile']);
    Route::post('/profileUpdate', 'UserController@editProfile');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/codeTypes', ['uses' => 'CodeController@showCodeTypes', 'as' => 'code.codeTypes']);
        Route::get('/codeType/{id}', ['uses' => 'CodeController@showCodesForType']);
        Route::get('/addCodeType', ['uses' => 'CodeController@addCodeType']);
        Route::post('/addCodeType', ['uses' => 'CodeController@createCodeType']);

        Route::get('/codeType/addCode/{id}', ['uses' => 'CodeController@addCode']);
        Route::post('/addCode', ['uses' => 'CodeController@createCode']);
        Route::get('/codeType/code/{id}', ['uses' => 'CodeController@editCode']);
        Route::post('/editCode', ['uses' => 'CodeController@updateCode']);
    });
});
