<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\DashboardController;
use App\Models\CheckCodes;
use Carbon\Carbon;
use DB;
use App\Http\Requests;
use App\Http\Requests\AddMeasurementRequest;
use App\Models\CheckAllergyDisease;
use App\Models\CheckMedical;
use App\Models\CheckDiet;
use App\Models\Checks;
use App\Models\DoctorDates;
use App\Models\DoctorNurse;
use App\Models\Code;
use App\Models\Measurement;
use App\Models\MeasurementResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
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
     * Show the application measurements.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function newMeasurement(){

        $data = Array();
        $data['patient'] = Auth::user();
        if(!session('isMyProfile'))
            $data['patient'] = User::find(session('showUser'));

        $data['doctors'] = User::where('person_type', 4)->get();
        $data['codesMeasurement'] = Code::where('code_type', 15)->get();

        return view('measurements.add')->with($data);
    }

    public function addMeasurement(AddMeasurementRequest $request){

        $type = Code::find($request->type);

        if($request->result < $type->min_value || $request->result > $type->max_value){
            return redirect()->back()->with('error', 'Napačna vrednost');
        }
        else{
            $measurement = new Measurement();

            if($request['provider'] > 0){
                $measurement->provider = $request['provider'];
            }
            else{
                $patient = User::findOrFail($request['patient']);
                $measurement->provider = $patient->personal_doctor_id;
            }

            $measurement->patient = $request['patient'];
            $measurement->type = $request['type'];
            $measurement->check = null;
            $measurement->time = Carbon::createFromFormat('Y-m-d H:i', $request['date'] . " " . $request['time']);

            $measurement->save();

            $measurementResult = new MeasurementResult();
            $measurementResult->measurement = $measurement->id;
            $measurementResult->type = $request['type'];
            $measurementResult->result = $request['result'];

            $measurementResult->save();

            return redirect()->back()->with('msg', 'Meritev je bila dodana');
        }
    }

}