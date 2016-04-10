<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\CheckMedical;
use App\Models\Checks;
use App\Models\DoctorDates;
use App\Models\DoctorNurse;
use App\Models\Code;
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
        $this->authorize('canViewProfile', $user);
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

        $data['checks'] = Checks::where('patient', $user->id)->get();
        if(count($data['checks']) > 0){
            foreach ($data['checks'] as $check) {
                $data['checkMedical'][$check->id] = CheckMedical::where('check', $check->id)->get();
                if(count($data['checkMedical'][$check->id]) > 0){
                    foreach ($data['checkMedical'][$check->id] as $medical) {
                        $data['checkMedical'][$check->id][$medical->id] = Code::find($medical['cure']);
                    }
                }
            }
        }

        return view('dashboard')->with($data);
    }

}
