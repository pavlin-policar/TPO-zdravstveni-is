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
use App\Models\MeasurementMeasurement;
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

        $data['codesMeasurement'] = Code::where('code_type', 15)->get();
        $data['bigMeasurement'] = Code::where('code_type', 16)->get();

        if(count($data['bigMeasurement']) > 0)
        foreach($data['bigMeasurement'] as $m) {
            $smallMeasurement = MeasurementMeasurement::where('big_measurement', $m->id)->select('small_measurement')->get();
            $m['count'] = count($smallMeasurement);
            $m['small'] = Array();
            $m['small'] = Code::where('id', $smallMeasurement[0]['small_measurement'])->get();
            for ($x = 1; $x < count($smallMeasurement); $x++) {
                $m['small'][$x] = Code::find($smallMeasurement[$x]['small_measurement']);
            }
        }

        return view('measurements.add')->with($data);
    }

    public function addMeasurement(AddMeasurementRequest $request){echo $request;
/*
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
            if(isset($request['weight']) || $request['weight'] != null){
                $bmi = $request['weight'] / (($request['result']/100)*($request['result']/100));
                $measurementResult->result = (round($bmi*100))/100;
                echo $request['weight'];
            }
            else{
                $measurementResult->result = $request['result'];
            }

            $measurementResult->save();

            return redirect()->back()->with('msg', 'Meritev je bila dodana');
        }*/
    }

    public function editMeasurement($id){

        $m = Measurement::find($id);
        $me = Auth::user();
        $user = Auth::user();

        if(!session('isMyProfile'))
            $user = User::find(session('showUser'));

        if($m->patient == $user->id || $m->patient == $me->id){

            $data = Array();
            $data['patient'] = $user;
            $data['codesMeasurement'] = Code::where('code_type', 15)->get();
            $data['measurement'] = Measurement::join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                ->select('measurements.*', 'measurement_results.result')
                ->where('measurements.id', "=", $id)
                ->first();


            return view('measurements.edit')->with($data);
        }
        else {
            return redirect('logout');
        }
    }

    public function updateMeasurement(AddMeasurementRequest $request, $id){

        $type = Code::find($request->type);
        $measurement = Measurement::find($id);

        if($measurement->check > 0){
            return redirect()->back()->with('error', 'Te meritve ni dovoljeno urejati');
        }
        else if($request->result < $type->min_value || $request->result > $type->max_value){
            return redirect()->back()->with('error', 'Napačna vrednost');
        }
        else {

            if($request['provider'] > 0){
                $measurement->provider = $request['provider'];
            }
            $measurement->patient = $request['patient'];
            $measurement->type = $request['type'];
            $measurement->time = Carbon::createFromFormat('Y-m-d H:i', $request['date'] . " " . $request['time']);

            $measurement->update();

            $measurementResult = MeasurementResult::where('measurement', $id)->first();
            $measurementResult->type = $request['type'];
            $measurementResult->result = $request['result'];

            $measurementResult->update();

            return redirect()->back()->with('msg', 'Meritev je bila spremenjena');
        }
    }

    public function deleteMeasurement($id){

        $measurement = Measurement::find($id);

        if($measurement->check > 0){
            return redirect()->back()->with('error', 'Te meritve ni dovoljeno brisati');
        }
        else{
            MeasurementResult::where('measurement', $id)->delete();
            Measurement::destroy($id);
            return redirect()->route('check.measurement')->with('msg', 'Meritev je bila izbrisana');
        }
    }
}