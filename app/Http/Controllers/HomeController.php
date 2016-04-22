<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use App\Http\Requests;
use App\Models\CheckAllergyDisease;
use App\Models\CheckMedical;
use App\Models\CheckDiet;
use App\Models\Checks;
use App\Models\DoctorDates;
use App\Models\DoctorNurse;
use App\Models\Code;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    public function dashboard(User $user)
    {
        if (!$user->existsInStorage()) {
            if(!empty(session('showUser')))
                $user=User::findOrFail(session('showUser'));
            else
                $user = Auth::user();
        }
        $data['user']=$user;
        $data['isMyProfile']=session('isMyProfile');
        $data['personal_doctor'] = User::find($user->personal_doctor_id);
        $data['personal_dentist'] = User::find($user->personal_dentist_id);
        $data['doctorDates'] = DoctorDates::where('patient', $user->id)->get();
        if(count($data['doctorDates']) > 0){
            foreach ($data['doctorDates'] as $check) {
                $data['doktorCheck'][$check->doctor] = User::find($check->doctor);
            }
        }
        $nurses = DoctorNurse::where('doctor', $user->personal_doctor_id)->get();
        if(count($nurses) > 0){
            foreach ($nurses as $nurse) {
                $data['doctorNurse'][$nurse->nurse] = User::find($nurse->nurse);
            }
        }
        $nurses = DoctorNurse::where('doctor', $user->personal_dentist_id);
        if(count($nurses) > 0){
            foreach ($nurses as $nurse) {
                $data['dentistNurse'][$nurse->nurse] = User::find($nurse->nurse);
            }
        }



        $data['checkData'] = DB::table('checks_codes')
                                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                                ->select('checks_codes.*', 'codes.name', 'codes.code_type')
                                ->where('checks.patient', '=', $user->id)
                                ->where('checks_codes.start', '<', Carbon::now())
                                ->where(function($query){
                                    return $query->where('checks_codes.end', '>', Carbon::now())
                                        ->orWhere('checks_codes.end', '=', null);
                                })
                                ->get();

        $data['checkCountMedical'] = DB::table('checks_codes')
                                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                                ->select('checks_codes.id')
                                ->where('codes.code_type', 14)
                                ->where('checks.patient', '=', $user->id)
                                ->where(function($query){
                                return $query->where('checks_codes.end', '>', Carbon::now())
                                        ->orWhere('checks_codes.end', '=', null);
                                })
                                ->count();

        $data['checkCountDisease'] = DB::table('checks_codes')
                                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                                ->select('checks_codes.*')
                                ->where('codes.code_type', 13)
                                ->where('checks.patient', '=', $user->id)
                                ->where('checks_codes.start', '<', Carbon::now())
                                ->where(function($query){
                                    return $query->where('checks_codes.end', '>', Carbon::now())
                                        ->orWhere('checks_codes.end', '=', null);
                                })
                                ->count();

        $data['checkCountDiet'] = DB::table('checks_codes')
                                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                                ->select('checks_codes.*')
                                ->where('codes.code_type', 12)
                                ->where('checks.patient', '=', $user->id)
                                ->where('checks_codes.start', '<', Carbon::now())
                                ->where(function($query){
                                    return $query->where('checks_codes.end', '>', Carbon::now())
                                        ->orWhere('checks_codes.end', '=', null);
                                })
                                ->count();

        $data['checkMeasurement'] = DB::table('codes')
                                ->join('code_types', 'codes.code_type', '=', 'code_types.id')
                                ->join('measurements', 'codes.id', '=', 'measurements.type')
                                ->select('measurements.*', 'code_types.name')
                                ->where('measurements.patient', '=', $user->id)
                                ->get();

        $data['checksOld'] = DB::table('checks')
                                ->join('users', 'checks.doctor', '=', 'users.id')
                                ->join('doctor_dates', 'checks.doctor_date', '=', 'doctor_dates.id')
                                ->select('checks.id', 'users.first_name', 'users.last_name', 'doctor_dates.note', 'doctor_dates.time')
                                ->where('checks.patient', $user->id)
                                ->where('doctor_dates.time', '<', Carbon::now())
                                ->get();

        return view('dashboard')->with($data);
    }

}
