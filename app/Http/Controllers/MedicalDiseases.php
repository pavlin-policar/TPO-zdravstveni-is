<?php

namespace App\Http\Controllers;

use App\Models\AllergiesAndDiseasesMedical;
use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\CodeType;
use App\Http\Requests;
use DB;

class MedicalDiseases extends Controller
{
    public function showDiseases()
    {
        $codeType = CodeType::findOrFail(14);
        $data['codeType'] = $codeType->name;
        $data['codeTypeDescription'] = $codeType->description;
        $data['array'] = Code::where('code_type', 13)->get();
        return view('medicalDiseases.DiseasesList')->with($data);
    }

    public function editMedicals(Code $code)
    {
        $data['code'] = $code;
        $data['goodMedicals'] = AllergiesAndDiseasesMedical::join('codes', 'allergies_and_diseases_medical.cure', '=', 'codes.id')
            ->select('codes.*')
            ->where('allergies_and_diseases_medical.allergy_or_disease', '=', $code->id)
            ->get();
        $notIn = Array();
        foreach($data['goodMedicals'] as $m){
            $notIn[]=$m->id;
        } //kompliciranje, ce znas bol, poprav
        $data['allMedicals'] = Code::where('code_type', 14)->whereNotIn('id', $notIn)->get();
        //die(var_dump($disease));
        $data['back'] = "medicalDiseases.list";
        $data['save'] = "diseases.editMedicalList";
        $data['postParameter'] = "medicals";
        return view('medicalDiseases.diseasesMedical')->with($data);
    }

    public function editMedicalsList(Request $request)
    {
        $id=$request['id'];
        $medicals=explode(",",$request['medicals']);
        if(empty($id))
            die("Empty");
        $old = AllergiesAndDiseasesMedical::join('codes', 'allergies_and_diseases_medical.cure', '=', 'codes.id')
            ->select('codes.*')
            ->where('allergies_and_diseases_medical.allergy_or_disease', '=', $id)
            ->get();
        foreach($old as $new){
            if(in_array($new->id,$medicals)){
                //echo $id." ostane";
                if(($key = array_search($new->id, $medicals)) !== false) {
                    unset($medicals[$key]);
                }
            } else {
                //echo $id." izbris";
                $new->delete();
            }
        }
        if(!empty($medicals))
            foreach ($medicals as $medical) {
                if(empty($medical))
                    continue;
                //echo $medical." dodaj";
                $new = new AllergiesAndDiseasesMedical();
                $new->allergy_or_disease = $id;
                $new->cure = $medical;
                $new->save();
            }
        //var_dump($medicals);
        return redirect()->route('medicalDiseases.list');
    }
}
