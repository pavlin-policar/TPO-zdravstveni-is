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

    Route::get('registration/resend', [
        'as' => 'registration.resend-email',
        'uses' => 'Auth\AuthController@resendEmail',
    ]);

    Route::post('registration/resend', [
        'as' => 'registration.resend-email',
        'uses' => 'Auth\AuthController@resendInputEmail',
    ]);

    Route::post('registration/confirm/', [
        'as' => 'registration.do-confirm-email',
        'uses' => 'Auth\AuthController@confirm',
    ]);

    Route::get('profile/delete-success', [
        'as' => 'profile.deleted',
        'uses' => 'UserController@accountDeletedPage',
    ]);
});

/**
 * Routes that only authenticated users can access, but they needn't have activated their email or
 * completed the registration process yet.
 */
Route::group(['middleware' => ['web', 'auth']], function () {});

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
	
    Route::get('/calendar', [
        'as' => 'calendar.user',
        'uses' => 'CalendarController@index',
    ]);

    Route::get('/calendar/schedule', [
        'as' => 'calendar.schedule',
        'uses' => 'CalendarController@manageSchedule',
    ]);

    Route::post('/calendar/schedule', [
        'as' => 'calendar.schedule',
        'uses' => 'CalendarController@createSchedule',
    ]);

    Route::get('/calendar/cloner', [
        'as' => 'calendar.cloneWeek',
        'uses' => 'CalendarController@cloneWeek',
    ]);

    Route::get('/calendar/break/{time}/{user}/{doctor}', [
        'as' => 'calendar.introduceBreak',
        'uses' => 'CalendarController@introduceBreak',
    ]);

    Route::get('/calendar/cancelEvent/{time}/{user}/{doctor}', [
        'as' => 'calendar.cancelEvent',
        'uses' => 'CalendarController@cancel',
    ]);

    Route::post('/calendar/cancelEvent/{time}/{user}/{doctor}', [
        'as' => 'calendar.cancelEvent',
        'uses' => 'CalendarController@cancel',
    ]);

    Route::get('/calendar/registerEvent/{time}/{user}/{doctor}', [
        'as' => 'calendar.registerEvent',
        'uses' => 'CalendarController@registerEventForm',
    ]);

    Route::post('/calendar/registerEvent/{time}/{user}/{doctor}', [
        'as' => 'calendar.registerEvent',
        'uses' => 'CalendarController@register',
    ]);


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
    Route::delete('profile/{user}', [
        'uses' => 'UserController@deleteAccount',
        'as' => 'profile.delete-account',
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

    Route::get('/check/medical/{user?}', [
        'uses' => 'CheckController@showMedical',
        'as' => 'check.medical'
    ]);

    Route::get('/check/measurement/{user?}', [
        'uses' => 'CheckController@showMeasurement',
        'as' => 'check.measurement'
    ]);

    Route::get('/check/disease/{user?}', [
        'uses' => 'CheckController@showDisease',
        'as' => 'check.disease'
    ]);

    Route::get('/check/diet/{user?}', [
        'uses' => 'CheckController@showDiet',
        'as' => 'check.diet'
    ]);

    Route::get('/check/{id}', [
        'uses' => 'CheckController@show',
        'as' => 'check.show'
    ]);
    Route::get('/special-list/{codeType}', [
        'uses' => 'CodeController@specialList',
        'as' => 'code.specialList',
    ]);
    Route::get('/special-list/detail/{code}', [
        'uses' => 'CodeController@specialListDetail',
        'as' => 'code.publicDetail',
    ]);
    /**
     * Routes only available to the doctor user.
     */
    Route::group(['middleware' => 'doctor'], function () {

        Route::post('/doctor/check', [
            'uses' => 'CheckController@checkAdd',
            'as' => 'check.create'
        ]);

        Route::post('/doctor/check/code', [
            'uses' => 'CheckController@checkAddCode',
            'as' => 'check.createCode'
        ]);

        Route::post('/doctor/check/measurement', [
            'uses' => 'CheckController@checkAddMeasurement',
            'as' => 'check.createMeasurement'
        ]);

        Route::put('/doctor/check/{id}', [
            'uses' => 'CheckController@checkUpdate',
            'as' => 'check.update'
        ]);

        Route::put('/doctor/check/code/{id}', [
            'uses' => 'CheckController@checkUpdateCode',
            'as' => 'check.updateCode'
        ]);

        Route::put('/doctor/check/measurement/{id}', [
            'uses' => 'CheckController@checkUpdateMeasurement',
            'as' => 'check.updateMeasurement'
        ]);

        Route::get('/doctor/check/{id}', [
            'uses' => 'CheckController@doctorDate',
            'as' => 'check.doctor'
        ]);
    });

    /**
     * Routes only available to the admin user.
     */
    Route::group(['middleware' => 'admin'], function () {

        Route::get('/manuals', [
            'uses' => 'ManualController@showList',
            'as' => 'manuals.list',
        ]);
        Route::get('/manual/create', [
            'uses' => 'ManualController@addManual',
            'as' => 'manuals.getCreate',
        ]);
        Route::post('/manuals', [
            'uses' => 'ManualController@createManual',
            'as' => 'manuals.postCreate',
        ]);
        Route::get('/manual/{manual}', [
            'uses' => 'ManualController@editManual',
            'as' => 'manuals.edit',
        ]);
        Route::post('/manual/{manual}', [
            'uses' => 'ManualController@updateManual',
            'as' => 'manuals.update',
        ]);
        Route::get('/medicals-diseases', [
            'uses' => 'MedicalDiseases@showDiseases',
            'as' => 'medicalDiseases.list',
        ]);
        Route::get('/medicals-diseases/disease/{code}', [
            'uses' => 'MedicalDiseases@editMedicals',
            'as' => 'diseases.editList',
        ]);
        Route::post('/medicals-diseases/disease/update', [
            'uses' => 'MedicalDiseases@editMedicalsList',
            'as' => 'diseases.editMedicalList',
        ]);
        Route::get('/code/{code}/manuals', [
            'uses' => 'ManualController@editCodeManual',
            'as' => 'code.addManuals',
        ]);
        Route::post('/code/manuals/update', [
            'uses' => 'ManualController@updateManualsList',
            'as' => 'manuals.editManualsList',
        ]);
        Route::get('/code-types', [
            'uses' => 'CodeController@showCodeTypes',
            'as' => 'code.index',
        ]);
        Route::get('/code-types/create', [
            'uses' => 'CodeController@addCodeType',
            'as' => 'codeTypes.getCreate',
        ]);
        Route::get('/code-types/{codeType}{extension?}', [
            'uses' => 'CodeController@showCodesForType',
            'as' => 'codeTypes.show',
        ])->where(['codeType' => '[0-9]+', 'extension' => '\..+']);
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

        Route::get('/users{extension?}', [
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
        Route::get('/users/restore/{deletedUser}', [
            'uses' => 'UserAdminController@restore',
            'as' => 'users.restore',
        ]);
    });
});
