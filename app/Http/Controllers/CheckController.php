<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Checks;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
        $data['check'] = DB::table('checks')
            ->join('users', 'checks.doctor', '=', 'users.id')
            ->join('doctor_dates', 'checks.doctor_date', '=', 'doctor_dates.id')
            ->select('doctor_dates.time', 'users.first_name', 'users.last_name')
            ->where('checks.id', '=', $id)
            ->first();

        $data['checkData'] = DB::table('checks_codes')
            ->join('checks', 'checks_codes.check', '=', 'checks.id')
            ->join('codes', 'checks_codes.code', '=', 'codes.id')
            ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
            ->where('checks.id', '=', $id)
            ->get();
        $data['checkCountMedical'] = DB::table('checks_codes')
            ->join('checks', 'checks_codes.check', '=', 'checks.id')
            ->join('codes', 'checks_codes.code', '=', 'codes.id')
            ->select('checks_codes.id')
            ->where('checks.id', $id)
            ->where('codes.code_type', 14)
            ->count();
        $data['checkCountDisease'] = DB::table('checks_codes')
            ->join('checks', 'checks_codes.check', '=', 'checks.id')
            ->join('codes', 'checks_codes.code', '=', 'codes.id')
            ->select('checks_codes.*')
            ->where('checks.id', '=', $id)
            ->where('codes.code_type', 13)
            ->count();
        $data['checkCountDiet'] = DB::table('checks_codes')
            ->join('checks', 'checks_codes.check', '=', 'checks.id')
            ->join('codes', 'checks_codes.code', '=', 'codes.id')
            ->select('checks_codes.*')
            ->where('checks.id', '=', $id)
            ->where('codes.code_type', 12)
            ->count();


        $data['checkMeasurement'] = DB::table('measurements')
            ->join('codes', 'measurements.type', '=', 'codes.id')
            ->join('code_types', 'code_types.id', '=', 'codes.code_type')
            ->join('users', 'measurements.provider', '=', 'users.id')
            ->join('checks', 'measurements.check', '=', 'checks.id')
            ->join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
            ->select('measurements.*', 'users.first_name', 'users.last_name', 'checks.note', 'measurement_results.result', 'code_types.name')
            ->where('checks.id', '=', $id)
            ->get();

        return view('checks.show')->with($data);
    }

    public function showMedical(User $user)
    {
        if (!$user->existsInStorage()) {
            $user = Auth::user();
        }
        $data['medicals'] =  DB::table('checks_codes')
                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
                ->where('checks.patient', '=', $user->id)
                ->where('codes.code_type', 14)
                ->get();
        return view('checks.medical')->with($data);
    }

    public function showDisease(User $user)
    {
        if (!$user->existsInStorage()) {
            $user = Auth::user();
        }
        $data['diseases'] =  DB::table('checks_codes')
                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
                ->where('checks.patient', '=', $user->id)
                ->where('codes.code_type', 13)
                ->get();
        return view('checks.disease')->with($data);
    }

    public function showDiet(User $user)
    {
        if (!$user->existsInStorage()) {
            $user = Auth::user();
        }
        $data['diets'] =  DB::table('checks_codes')
                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
                ->where('checks.patient', '=', $user->id)
                ->where('codes.code_type', 12)
                ->get();
        return view('checks.diet')->with($data);
    }

}