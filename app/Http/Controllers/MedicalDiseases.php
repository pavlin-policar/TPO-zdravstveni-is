<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\CodeType;
use App\Http\Requests;

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
}
