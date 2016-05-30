<?php

namespace App\Http\Controllers;

use App\Models\MeasurementMeasurement;
use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\CodeType;
use App\Http\Requests;
use DB;

class MeasurementMeasurementController extends Controller
{
    public function showMeasurements()
    {
        $codeType = CodeType::findOrFail(16);
        $data['codeType'] = $codeType->name;
        $data['codeTypeDescription'] = $codeType->description;
        $data['array'] = Code::where('code_type', 16)->get();
        return view('measurementMeasurement.MeasurementsList')->with($data);
    }

    public function editMeasurement(Code $code)
    {
        $data['code'] = $code;
        $data['goodMedicals'] = MeasurementMeasurement::join('codes', 'measurement_measurement.small_measurement', '=', 'codes.id')
            ->select('codes.*')
            ->where('measurement_measurement.big_measurement', '=', $code->id)
            ->get();
        $notIn = Array();
        foreach($data['goodMedicals'] as $m){
            $notIn[]=$m->id;
        } //kompliciranje, ce znas bol, poprav
        $data['allMedicals'] = Code::where('code_type', 15)->whereNotIn('id', $notIn)->get();
        //die(var_dump($disease));
        $data['back'] = "measurementMeasurement.list";
        $data['save'] = "measurementMeasurement.editMeasurementList";
        $data['postParameter'] = "big_measurement";
        return view('medicalDiseases.diseasesMedical')->with($data);
    }

    public function editMeasurementList(Request $request)
    {
        $id=$request['id'];
        $medicals=explode(",",$request['big_measurement']);
        if(empty($id))
            die("Empty");
        $old = MeasurementMeasurement::join('codes', 'measurement_measurement.small_measurement', '=', 'codes.id')
            ->select('codes.*')
            ->where('measurement_measurement.big_measurement', '=', $id)
            ->get();
        foreach($old as $new){
            if(in_array($new->id,$medicals)){
                //echo $new->id." ostane";
                if(($key = array_search($new->id, $medicals)) !== false) {
                    unset($medicals[$key]);
                }
            } else {
                //echo $new->id." izbris";
                $new->delete();
            }
        }
        //die();
        if(!empty($medicals))
            foreach ($medicals as $medical) {
                if(empty($medical))
                    continue;
                //echo $medical." dodaj";
                $new = new MeasurementMeasurement();
                $new->big_measurement = $id;
                $new->small_measurement = $medical;
                $new->save();
            }
        //var_dump($medicals);
        return redirect()->route('measurementMeasurement.list');
    }
}
