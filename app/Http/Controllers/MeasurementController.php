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

    public function newMeasurement(Request $request){

        $id = $request['type'];
        $data = Array();
        $data['selected'] = false;
        $data['big'] = false;
        $data['id'] = 0;
        $data['provider'] = Auth::user();

        if(session('isMyProfile'))
            $data['patient'] = Auth::user();
        else
            $data['patient'] = User::find(session('showUser'));

        $data['codesMeasurement'] = Code::where('code_type', 15)->get();
        $data['bigMeasurement'] = Code::where('code_type', 16)->get();

        if(isset($id) && $id > 0){
            $data['id'] = $id;
            $data['measurement'] = Code::find($id);
            $tipMeritve = $data['measurement']->name;
            if(isset($data['measurement'])){
                if($data['measurement']->code_type == 15){
                    $data['selected'] = true;
                }
                else if($data['measurement']->code_type == 16){
                    $data['selected'] = true;
                    $data['big'] = true;
                    $smallMeasurement = MeasurementMeasurement::where('big_measurement', $data['measurement']->id)->select('small_measurement')->get();
                    if(count($smallMeasurement)>0) {
                        $data['measurement']['small'] = Code::where('id', $smallMeasurement[0]['small_measurement'])->get();
                        for ($x = 1; $x < count($smallMeasurement); $x++) {
                            $data['measurement']['small'][$x] = Code::find($smallMeasurement[$x]['small_measurement']);
                        }
                    }
                    else{
                        return redirect()->back()->with('error', "Meritev $tipMeritve je prazna");
                    }
                }
            }

        }

        return view('measurements.add')->with($data);
    }

    public function addMeasurement(AddMeasurementRequest $request){

        $type = Code::find($request->type);

        if($request->result < $type->min_value || $request->result > $type->max_value || $request['date'] > Carbon::now()){
            return redirect()->back()->with('error', 'Napačna vrednost');
        }
        else if( Carbon::createFromFormat('Y-m-d', $request['date']) > Carbon::now()){
            return redirect()->back()->with('error', "Napačen datum");
        }
        else{
            if(isset($request['result']) || $request['result'] != null) {

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
                if (isset($request['weight']) && $request['weight'] != null && $request['weight'] > 0) {
                    $bmi = $request['weight'] / (($request['result'] / 100) * ($request['result'] / 100));
                    $measurementResult->result = (round($bmi * 100)) / 100;
                } else {
                    $measurementResult->result = $request['result'];
                }
                $measurementResult->save();
            }
            else {
                $small = MeasurementMeasurement::where('big_measurement', $request['type'])->get();

                $stack = array();
                if (isset($request['result0'])) {
                    array_push($stack, $request['result0']);
                }
                if (isset($request['result1'])) {
                    array_push($stack, $request['result1']);
                }
                if (isset($request['result2'])) {
                    array_push($stack, $request['result2']);
                }
                if (isset($request['result3'])) {
                    array_push($stack, $request['result3']);
                }
                if (isset($request['result4'])) {
                    array_push($stack, $request['result4']);
                }
                $x=0;
                foreach($small as $s){
                    $measurement = new Measurement();
                    if($request['provider'] > 0){
                        $measurement->provider = $request['provider'];
                    }
                    else{
                        $patient = User::findOrFail($request['patient']);
                        $measurement->provider = $patient->personal_doctor_id;
                    }
                    $measurement->patient = $request['patient'];
                    $measurement->type = $s->small_measurement;
                    $measurement->check = null;
                    $measurement->time = Carbon::createFromFormat('Y-m-d H:i', $request['date'] . " " . $request['time']);
                    $measurement->save();

                    $measurementResult = new MeasurementResult();
                    $measurementResult->measurement = $measurement->id;
                    $measurementResult->type = $s->small_measurement;
                    $measurementResult->result = $stack[$x];
                    $measurementResult->save();

                    $x++;
                }

                //print_r($stack);
            }

            return redirect()->back()->with('msg', 'Meritev je bila dodana');
        }
    }

    public function editMeasurement($id){

        $m = Measurement::find($id);
        $me = Auth::user();
        $user = Auth::user();

        if(!session('isMyProfile'))
            $user = User::find(session('showUser'));

        if($m->patient == $user->id || $m->patient == $me->id){

            $data = Array();
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

        $me = Auth::user();
        $type = Code::find($request->type);
        $measurement = Measurement::find($id);

        if(($measurement->check > 0)||($measurement->provider != $me->id)){
            return redirect()->back()->with('error', 'Te meritve ni dovoljeno urejati');
        }
        else if($request->result < $type->min_value || $request->result > $type->max_value){
            return redirect()->back()->with('error', 'Napačna vrednost');
        }
        else if( Carbon::createFromFormat('Y-m-d', $request['date']) > Carbon::now()){
            return redirect()->back()->with('error', "Napačen datum");
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
        $me = Auth::user();

        if($measurement->check > 0 || $measurement->provider != $me->id){
            return redirect()->back()->with('error', 'Te meritve ni dovoljeno brisati');
        }
        else{
            MeasurementResult::where('measurement', $id)->delete();
            Measurement::destroy($id);
            return redirect()->route('check.measurement')->with('msg', 'Meritev je bila izbrisana');
        }
    }
}