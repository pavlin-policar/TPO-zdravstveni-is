<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CheckCodeRequest;
use App\Http\Requests\CheckMeasurementRequest;
use App\Http\Requests\CheckRequest;
use App\Models\CheckCodes;
use App\Models\Checks;
use App\Models\Code;
use App\Models\DoctorDates;
use App\Models\Measurement;
use App\Models\MeasurementMeasurement;
use App\Models\MeasurementResult;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
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

    public function show($id) {

        $thisCheck = Checks::findOrFail($id);
        //die($thisCheck->patient ."=". session('user'));
        if(($thisCheck->doctor == session('user'))||($thisCheck->patient == session('user'))||($thisCheck->patient == session('showUser'))) {
            $data['check'] = DB::table('checks')
                ->join('users', 'checks.doctor', '=', 'users.id')
                ->join('doctor_dates', 'checks.doctor_date', '=', 'doctor_dates.id')
                ->select('doctor_dates.time', 'users.first_name', 'users.last_name', 'checks.note')
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

            $data['checkMeasurement'] = Measurement::join('codes', 'measurements.type', '=', 'codes.id')
                ->join('users', 'measurements.provider', '=', 'users.id')
                ->join('checks', 'measurements.check', '=', 'checks.id')
                ->join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                ->select('measurements.time', 'users.first_name', 'users.last_name', 'checks.note', 'measurement_results.result', 'codes.name', 'codes.description')
                ->where('checks.id', '=', $id)
                ->get();

            return view('checks.show')->with($data);
        }
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function showMedical(User $user)
    {
        if (!$user->existsInStorage()) {
            if(session('isMyProfile'))
                $user = Auth::user();
            else
                $user = User::find(session('showUser'));

            $data['medicals'] =  DB::table('checks_codes')
                ->join('checks', 'checks_codes.check', '=', 'checks.id')
                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
                ->where('checks.patient', '=', $user->id)
                ->where('codes.code_type', 14)
                ->orderBy('checks_codes.start', 'desc')
                ->get();
            return view('checks.medical')->with($data);
        }
        else {
            return abort(404, 'Not found.');
        }
    }

    public function showMeasurement(Request $request){

        $id = $request->type;
        $from = $request->from;
        $to = $request->to;

        $data = Array();
        $data['from'] = $from;
        $data['to'] = $to;
        $data['type'] = null;
        $data['graph'] = null;

        if($from == null){
            $from = Carbon::create(1970, 1, 1);
        }
        if($to == null){
            $to = Carbon::tomorrow('Europe/London');
        }

        if(session('isMyProfile'))
            $user = Auth::user();
        else
            $user = User::find(session('showUser'));

        if ($user->existsInStorage()) {

            $data['typeID'] = $id;
            $data['codesMeasurement'] = Code::where('code_type', '>=', 15)->where('code_type', '<=', 16)->get();
            $data['measurements'] = Measurement::join('codes', 'measurements.type', '=', 'codes.id')
                ->join('users', 'measurements.provider', '=', 'users.id')
                ->join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                ->select('measurements.*', 'codes.name', 'codes.description', 'users.first_name', 'users.last_name', 'measurement_results.result')
                ->where('measurements.patient', '=', $user->id)
                ->orderBy('measurements.time', 'desc')
                ->get();

            if(isset($id)&&!empty($id)) {
                $data['type'] = Code::find($id);
                if ($data['type']->code_type == 15) {

                    $data['graph'] = Measurement::join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                        ->select('measurement_results.result', 'measurements.time')
                        ->where('measurements.type', $id)
                        ->where('measurements.patient', '=', $user->id)
                        ->where('measurements.time', '>', $from)
                        ->where('measurements.time', '<=', $to)
                        ->orderBy('measurements.time', 'asc')
                        ->get();
                    if (!empty($data['type']['code'])) {
                        $data['normalValues'] = Code::where('code', "=", 'normal')
                            ->where('code_type', "=", $data['type']['code'])
                            ->first();
                    }
                } else if($data['type']->code_type == 16){
                    $small = MeasurementMeasurement::where('big_measurement', $request['type'])->select('small_measurement')->get();
                    if(count($small) == 2){
                        $data['type'] = Code::find($small[0]->small_measurement);
                        $data['type1'] = Code::find($small[1]->small_measurement);

                        $data['graph'] = Measurement::join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                            ->select('measurement_results.result', 'measurements.time')
                            ->where('measurements.type', $small[0]->small_measurement)
                            ->where('measurements.patient', '=', $user->id)
                            ->where('measurements.time', '>', $from)
                            ->where('measurements.time', '<=', $to)
                            ->orderBy('measurements.time', 'asc')
                            ->get();
                        if (!empty($data['type']['code'])) {
                            $data['normalValues'] = Code::where('code', "=", 'normal')
                                ->where('code_type', "=", $data['type']['code'])
                                ->first();
                        }
                        $data['graph1'] = Measurement::join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                            ->select('measurement_results.result', 'measurements.time')
                            ->where('measurements.type', $small[1]->small_measurement)
                            ->where('measurements.patient', '=', $user->id)
                            ->where('measurements.time', '>', $from)
                            ->where('measurements.time', '<=', $to)
                            ->orderBy('measurements.time', 'asc')
                            ->get();
                        if (!empty($data['type1']['code'])) {
                            $data['normalValues1'] = Code::where('code', "=", 'normal')
                                ->where('code_type', "=", $data['type1']['code'])
                                ->first();
                        }
                    }else if(count($small) == 3){
                        $data['type'] = Code::find($small[0]->small_measurement);
                        $data['type1'] = Code::find($small[1]->small_measurement);
                        $data['type2'] = Code::find($small[2]->small_measurement);

                        $data['graph'] = Measurement::join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                            ->select('measurement_results.result', 'measurements.time')
                            ->where('measurements.type', $small[0]->small_measurement)
                            ->where('measurements.patient', '=', $user->id)
                            ->where('measurements.time', '>', $from)
                            ->where('measurements.time', '<=', $to)
                            ->orderBy('measurements.time', 'asc')
                            ->get();
                        if (!empty($data['type']['code'])) {
                            $data['normalValues'] = Code::where('code', "=", 'normal')
                                ->where('code_type', "=", $data['type']['code'])
                                ->first();
                        }
                        $data['graph1'] = Measurement::join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                            ->select('measurement_results.result', 'measurements.time')
                            ->where('measurements.type', $small[1]->small_measurement)
                            ->where('measurements.patient', '=', $user->id)
                            ->where('measurements.time', '>', $from)
                            ->where('measurements.time', '<=', $to)
                            ->orderBy('measurements.time', 'asc')
                            ->get();
                        if (!empty($data['type1']['code'])) {
                            $data['normalValues1'] = Code::where('code', "=", 'normal')
                                ->where('code_type', "=", $data['type1']['code'])
                                ->first();
                        }
                        $data['graph2'] = Measurement::join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                            ->select('measurement_results.result', 'measurements.time')
                            ->where('measurements.type', $small[2]->small_measurement)
                            ->where('measurements.patient', '=', $user->id)
                            ->where('measurements.time', '>', $from)
                            ->where('measurements.time', '<=', $to)
                            ->orderBy('measurements.time', 'asc')
                            ->get();
                        if (!empty($data['type2']['code'])) {
                            $data['normalValues2'] = Code::where('code', "=", 'normal')
                                ->where('code_type', "=", $data['type2']['code'])
                                ->first();
                        }
                    }
                }
            }


            return view('checks.measurement')->with($data);
        }
        else {
            return abort(404, 'Not found.');
        }
    }

    public function showDisease(User $user)
    {
        if (!$user->existsInStorage()) {
            if(session('isMyProfile'))
                $user = Auth::user();
            else
                $user = User::find(session('showUser'));

            $data['diseases'] =  CheckCodes::join('checks', 'checks_codes.check', '=', 'checks.id')
                    ->join('codes', 'checks_codes.code', '=', 'codes.id')
                    ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
                    ->where('checks.patient', '=', $user->id)
                    ->where('codes.code_type', 13)
                    ->orderBy('checks_codes.start', 'desc')
                    ->get();
            return view('checks.disease')->with($data);
        }
        else {
            return abort(404, 'Not found.');
        }
    }

    public function showDiet(User $user)
    {
        if (!$user->existsInStorage()) {
            if(session('isMyProfile'))
                $user = Auth::user();
            else
                $user = User::find(session('showUser'));

            $data['diets'] =  CheckCodes::join('checks', 'checks_codes.check', '=', 'checks.id')
                ->join('codes', 'checks_codes.code', '=', 'codes.id')
                ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
                ->where('checks.patient', '=', $user->id)
                ->where('codes.code_type', 12)
                ->orderBy('checks_codes.start', 'desc')
                ->get();
            return view('checks.diet')->with($data);
        }
        else {
            return abort(404, 'Not found.');
        }
    }

    public function doctorDate($id, Request $request){

        $typeID = $request['type'];
        $data['dates'] =  DoctorDates::findOrFail($id);

        if($data['dates']->doctor == session('user')) {

            $data['patient'] = User::find($data['dates']->patient);
            $data['doctors'] = User::where('person_type', 4)->get();
            $data['codesMeasurement'] = Code::where('code_type', 15)->get();
            $data['bigMeasurement'] = Code::where('code_type', 16)->get();
            $data['checks'] = Checks::where('doctor_date', $id)->get();
            $data['codesMedical'] = Code::where('code_type', 14)->get();
            $data['codesDisease'] = Code::where('code_type', 13)->get();
            $data['codesDiet'] = Code::where('code_type', 12)->get();
            $data['selected'] = false;
            $data['big'] = false;

            if (count($data['checks']) > 0) {
                foreach ($data['checks'] as $check) {
                    $data['checkData'][$check->id] = CheckCodes::join('checks', 'checks_codes.check', '=', 'checks.id')
                        ->join('codes', 'checks_codes.code', '=', 'codes.id')
                        ->select('checks_codes.*', 'codes.name', 'codes.description', 'codes.code_type')
                        ->where('checks.id', '=', $check->id)
                        ->get();

                    $data['checkMeasurement'][$check->id] = Measurement::join('codes', 'measurements.type', '=', 'codes.id')
                        ->join('users', 'measurements.provider', '=', 'users.id')
                        ->join('checks', 'measurements.check', '=', 'checks.id')
                        ->join('measurement_results', 'measurements.id', '=', 'measurement_results.measurement')
                        ->select('measurements.*', 'users.id AS doctor', 'checks.note', 'measurement_results.result', 'codes.name', 'codes.description')
                        ->where('checks.id', '=', $check->id)
                        ->get();

                }
            }

            if(isset($typeID) && $typeID > 0){
                $data['typeID'] = $typeID;
                $data['measurement'] = Code::find($typeID);
                if(isset($data['measurement'])){
                    if($data['measurement']->code_type == 15){
                        $data['selected'] = true;
                    }
                    else if($data['measurement']->code_type == 16){
                        $data['selected'] = true;
                        $data['big'] = true;
                        $smallMeasurement = MeasurementMeasurement::where('big_measurement', $data['measurement']->id)->select('small_measurement')->get();
                        $data['measurement']['small'] = Code::where('id', $smallMeasurement[0]['small_measurement'])->get();
                        for ($x = 1; $x < count($smallMeasurement); $x++) {
                            $data['measurement']['small'][$x] = Code::find($smallMeasurement[$x]['small_measurement']);
                        }
                    }
                }
            }
            else{
                $data['typeID'] = 0;
            }

            return view('checks.doctor')->with($data);
        }
        else{
            return abort(403, 'Unauthorized action.');
        }
    }

    public function checkUpdate(CheckRequest $request, $id)
    {
        $check = Checks::find($id);
        $check->note = $request['note'];
        $check->patient = $request['patient'];
        $check->doctor = $request['doctor'];
        $check->doctor_date = $request['doctor_date'];

        $check->update();

        return redirect()->back()->with('Check', 'CheckUpdated');
    }

    public function checkUpdateCode(CheckCodeRequest $request, $id)
    {
        if((strlen($request->end) > 1) && (Carbon::createFromFormat('Y-m-d', $request['end']) < Carbon::createFromFormat('Y-m-d', $request['start']))){
            return redirect()->back()->with('errorCheck', 'Vnešen je napačen datum');
        }

        $checkCode = CheckCodes::find($id);
        $checkCode->note = $request['note'];
        $checkCode->start = $request['start'];
        if(strlen($request->end) <= 1)
            $request->end == NULL;
        else
            $checkCode->end = $request['end'];

        $checkCode->check = $request['check'];
        $checkCode->code = $request['code'];

        $checkCode->update();

        $check = Checks::find($checkCode->check);

        return redirect()->route('check.doctor', $check->doctor_date);
    }

    public function checkUpdateMeasurement(CheckMeasurementRequest $request, $id) {

        $type = Code::find($request->type);

        if($request->result < $type->min_value || $request->result > $type->max_value){
            return redirect()->back()->with('errorCheck', 'Napačna vrednost');
        }
        else if( Carbon::createFromFormat('Y-m-d', $request['date']) > Carbon::now()){
            return redirect()->back()->with('errorCheck', "Napačen datum");
        }
        else {
            $measurement = Measurement::find($id);
            $measurement->provider = $request['provider'];
            $measurement->patient = $request['patient'];
            $measurement->type = $request['type'];
            $measurement->check = $request['check'];
            $measurement->time = Carbon::createFromFormat('Y-m-d H:i', $request['date'] . " " . $request['time']);

            $measurement->update();

            $measurementResult = MeasurementResult::where('measurement', $id)->first();
            $measurementResult->type = $request['type'];
            $measurementResult->result = $request['result'];

            $measurementResult->update();

            return redirect()->back()->with('msg', 'Meritev je bila urejena');
        }
    }

    public function checkAdd(CheckRequest $request)
    {
        $check = new Checks();
        $check->note = $request['note'];
        $check->patient = $request['patient'];
        $check->doctor = $request['doctor'];
        $check->doctor_date = $request['doctor_date'];

        $check->save();

        return redirect()->back()->with('msg', 'Pregled je bil potrjen');
    }

    public function checkAddCode(CheckCodeRequest $request){

        if((strlen($request->end) > 1) && (Carbon::createFromFormat('Y-m-d', $request['end']) < Carbon::createFromFormat('Y-m-d', $request['start']))){
            return redirect()->back()->with('errorCheck', 'Vnešen je napačen datum');
        }

        $checkCode = new CheckCodes();
        $checkCode->note = $request['note'];
        $checkCode->start = $request['start'];
        if(strlen($request->end) <= 1)
            $request->end == NULL;
        else
            $checkCode->end = $request['end'];

        $checkCode->check = $request['check'];
        $checkCode->code = $request['code'];

        $checkCode->save();

        return redirect()->back()->with('msg', 'Podatki so bili dodani');
    }

    public function checkAddMeasurement(CheckMeasurementRequest $request) {

        $type = Code::find($request->type);

        if($request->result < $type->min_value || $request->result > $type->max_value){
            return redirect()->back()->with('errorCheck', 'Napačna vrednost');
        }
        else if( Carbon::createFromFormat('Y-m-d', $request['date']) > Carbon::now()){
           return redirect()->back()->with('errorCheck', "Napačen datum");
        }
        else{
            if(isset($request['result']) || $request['result'] != null) {
                $measurement = new Measurement();
                $measurement->provider = $request['provider'];
                $measurement->patient = $request['patient'];
                $measurement->type = $request['type'];
                $measurement->check = $request['check'];
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
                    $measurement->provider = $request['provider'];
                    $measurement->patient = $request['patient'];
                    $measurement->type = $s->small_measurement;
                    $measurement->check = $request['check'];
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


}