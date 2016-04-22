<?php

namespace App\Http\Controllers;

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
        $data['code'] = $code->name;
        $data['codeDescription'] = $code->description;
        $data['goodMedicals'] = DB::table('allergies_and_diseases_medical')
            ->join('codes', 'allergies_and_diseases_medical.cure', '=', 'codes.id')
            ->select('codes.*')
            ->where('allergies_and_diseases_medical.allergy_or_disease', '=', $code->id)
            ->get();
        $data['allMedicals'] = Code::where('code_type', 14)->get();
        //die(var_dump($disease));
        return view('medicalDiseases.diseasesMedical')->with($data);
    }
}
