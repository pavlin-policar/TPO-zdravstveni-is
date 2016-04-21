<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Checks;
use DB;


class CheckController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function show($id)
    {
        /*
         * $data['checksOld'] = DB::table('checks')
                                ->join('users', 'checks.doctor', '=', 'users.id')
                                ->join('doctor_dates', 'checks.doctor_date', '=', 'doctor_dates.id')
                                ->select('checks.id', 'users.first_name', 'users.last_name', 'doctor_dates.note', 'doctor_dates.time')
                                ->where('checks.patient', $user->id)
                                ->where('doctor_dates.time', '<', Carbon::now())
                                ->get();
         */

        $data['check'] = DB::table('checks')
            ->join('users', 'checks.doctor', '=', 'users.id')
            ->join('doctor_dates', 'checks.doctor_date', '=', 'doctor_dates.id')
            ->select('doctor_dates.time', 'users.first_name', 'users.last_name')
            ->where('checks.id', '=', $id)
            ->first();

        $data['checkMedical'] = DB::table('check_medical')
            ->join('checks', 'check_medical.check', '=', 'checks.id')
            ->join('codes', 'check_medical.cure', '=', 'codes.id')
            ->select('check_medical.*', 'codes.name', 'codes.description')
            ->where('checks.id', '=', $id)
            ->get();

        $data['checkMeasurement'] = DB::table('measurements')
            ->join('codes', 'measurements.type', '=', 'codes.id')
            ->join('code_types', 'code_types.id', '=', 'codes.code_type')
            ->join('users', 'measurements.provider', '=', 'users.id')
            ->join('checks', 'measurements.check', '=', 'checks.id')
            ->join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
            ->select('measurements.*', 'users.first_name', 'users.last_name', 'checks.note', 'measurement_results.result', 'code_types.name')
            ->where('checks.id', '=', $id)
            ->get();

        $data['checkAllergyDisease'] = DB::table('check_allergy_and_disease')
            ->join('checks', 'check_allergy_and_disease.check', '=', 'checks.id')
            ->join('codes', 'check_allergy_and_disease.allergy_or_disease', '=', 'codes.id')
            ->select('check_allergy_and_disease.*', 'codes.name')
            ->where('checks.id', '=', $id)
            ->get();

        $data['checkDiet'] = DB::table('check_diet')
            ->join('checks', 'check_diet.check', '=', 'checks.id')
            ->join('codes', 'check_diet.diet', '=', 'codes.id')
            ->select('check_diet.*', 'codes.name')
            ->where('checks.id', '=', $id)
            ->get();

        return view('checks.show')->with($data);
    }
}