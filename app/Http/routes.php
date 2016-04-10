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

    Route::get('registration/confirm', [
        'as' => 'registration.confirm-email',
        'uses' => 'Auth\AuthController@showConfirmationPage',
    ]);

    Route::post('registration/confirm/', [
        'as' => 'registration.do-confirm-email',
        'uses' => 'Auth\AuthController@confirm',
    ]);
});

/**
 * Routes that only authenticated users can access, but they needn't have activated their email or
 * completed the registration process yet.
 */
Route::group(['middleware' => ['web', 'auth']], function () {
});

/**
 * Routes that only authenticated users with activated emails can access, but they needn't have
 * completed the registration process.
 */
Route::group(['middleware' => ['web', 'auth', 'email-validated']], function () {
    Route::get('registration/step-2', [
        'uses' => 'UserController@showGotoCreateProfile',
        'as' => 'registration.step-2',
    ]);
    Route::get('profile/create', [
        'uses' => 'UserController@showCreateProfile',
        'as' => 'profile.getCreate',
    ]);
    Route::post('profile/create-patient', [
        'uses' => 'UserController@createPatientProfile',
        'as' => 'profile.postCreatePatient',
    ]);
    Route::post('profile/create-doctor', [
        'uses' => 'UserController@createDoctorProfile',
        'as' => 'profile.postCreateDoctor',
    ]);
});

/**
 * Routes accessible only for authenticated users who have completed registration.
 */
Route::group(['middleware' => ['web', 'authenticated']], function () {

    Route::get('/', function () {
        return redirect()->route('dashboard.show');
    });

    Route::get('/dashboard/{user?}', [
        'uses' => 'HomeController@dashboard',
        'as' => 'dashboard.show',
    ]);

    Route::get('/profile/{user?}', [
        'uses' => 'UserController@showProfile',
        'as' => 'profile.show'
    ]);
    Route::put('profile/{user}/update', [
        'uses' => 'UserController@updatePersonalInfo',
        'as' => 'profile.updatePersonal',
    ]);
    Route::put('profile/{user}/update-doctors', [
        'uses' => 'UserController@updateDoctors',
        'as' => 'profile.updateDoctors',
    ]);
    Route::put('profile/{user}/update-doctor', [
        'uses' => 'UserController@updateDoctorPersonalInfo',
        'as' => 'profile.updateDoctorPersonal',
    ]);
    Route::put('profile/{user}/password', [
        'uses' => 'UserController@changePassword',
        'as' => 'profile.changePassword',
    ]);

    Route::get('/charges', [
        'uses' => 'ChargeController@index',
        'as' => 'charges.index',
    ]);
    Route::get('/charges/activate/{user}', [
        'uses' => 'ChargeController@activate',
        'as' => 'charges.activate',
    ]);
    Route::get('/charges/deactivate', [
        'uses' => 'ChargeController@activate',
        'as' => 'charges.deactivate',
    ]);
    Route::get('/charges/create', [
        'uses' => 'ChargeController@create',
        'as' => 'charges.create',
    ]);
    Route::post('/charges', [
        'uses' => 'ChargeController@store',
        'as' => 'charges.store',
    ]);
    Route::put('/charges/{user}', [
        'uses' => 'ChargeController@update',
        'as' => 'charges.update',
    ]);
    Route::get('/charges/{user}', [
        'uses' => 'ChargeController@show',
        'as' => 'charges.show',
    ]);

    Route::get('/patients/{user}', [
        'uses' => 'PatientController@show',
        'as' => 'patient.show',
    ]);

    Route::post('/patients/date', [
        'uses' => 'PatientController@addDate',
        'as' => 'patient.addDate',
    ]);

    /**
     * Routes only available to the admin user.
     */
    Route::group(['middleware' => 'admin'], function () {
        
        Route::get('/code-types', [
            'uses' => 'CodeController@showCodeTypes',
            'as' => 'code.index',
        ]);
        Route::get('/code-types/create', [
            'uses' => 'CodeController@addCodeType',
            'as' => 'codeTypes.getCreate',
        ]);
        Route::get('/code-types/{id}', [
            'uses' => 'CodeController@showCodesForType',
            'as' => 'codeTypes.show',
        ]);
        Route::post('/code-types', [
            'uses' => 'CodeController@createCodeType',
            'as' => 'codeTypes.postCreate',
        ]);

        Route::get('/codeType/addCode/{codeType}', [
            'uses' => 'CodeController@addCode',
            'as' => 'code.getCreate',
        ]);
        Route::post('/addCode', [
            'uses' => 'CodeController@createCode',
            'as' => 'code.postCreate',
        ]);
        Route::get('/codeType/code/{code}', [
            'uses' => 'CodeController@editCode',
            'as' => 'code.edit',
        ]);
        Route::post('/editCode/code/{code}', [
            'uses' => 'CodeController@updateCode',
            'as' => 'code.update',
        ]);
        Route::get('/export/pdf/codeType/{id}', [
            'uses' => 'CodeController@exportCodeType',
            'as' => 'codeType.exportToPDF',
        ]);
        Route::delete('/editCode/code/{id}', [
            'uses' => 'CodeController@deleteCode',
            'as' => 'code.deleteCode',
        ]);

        Route::get('/users', [
            'uses' => 'UserAdminController@index',
            'as' => 'users.index',
        ]);
        Route::get('/users/create', [
            'uses' => 'UserAdminController@create',
            'as' => 'users.create',
        ]);
        Route::post('/users', [
            'uses' => 'UserAdminController@store',
            'as' => 'users.store',
        ]);
        Route::get('/users/create/{user}', [
            'uses' => 'UserAdminController@show',
            'as' => 'users.show',
        ]);
        Route::put('/users/create/{user}', [
            'uses' => 'UserAdminController@update',
            'as' => 'users.update',
        ]);
    });
});
