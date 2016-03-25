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

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/profile', array('uses' => 'UserController@showProfile'));
Route::get('user/{id}', 'UserController@showUser')->name('profile') ->where('id', '[0-9]+');
// route to show the login form
Route::get('login', array('uses' => 'UserController@showLogin'));
// route to process the form
Route::post('login', array('uses' => 'UserController@doLogin'));
Route::get('logout', array('uses' => 'UserController@doLogout'));

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

Route::group(['middleware' => ['web']], function () {
    //
});
