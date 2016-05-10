<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Code;
use App\Models\CodeType;
use App\Models\ManualsCodes;
use App\Models\AllergiesAndDiseasesMedical;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function showCodeTypes()
    {
        return view('code.codeTypes')
            ->with('codeTypes', CodeType::all());
    }

    /**
     * Get a listing of codes for the given code type.
     *
     * @param CodeType $codeType
     * @param string $extension
     * @return mixed
     * @throws \App\Exceptions\UnsupportedFileFormatException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showCodesForType(CodeType $codeType, $extension = null)
    {
        $this->authorize('can-see-code-type-codes', $codeType);

        if ($extension !== null) {
            return $this->generateExportFile($codeType, $extension, 'code.pdf.codes');
        } else {
            return view('code.codes')->with('codeType', $codeType);
        }
    }

    public function addCodeType()
    {
        return view('code.addCodeType');
    }

    public function createCodeType(Request $request)
    {
        CodeType::create($request->all());
        return redirect()->route('code.index');
    }

    public function addCode(CodeType $codeType)
    {
        $data['codeType'] = $codeType->name;
        $data['codeTypeID'] = $codeType->id;
        $data['back'] = $codeType->id;
        $data['code'] = null;
        return view('code.addCode')->with($data);
    }

    public function createCode(Request $request)
    {
        $code = Code::create($request->all());
        $code->code = $request->code;
        $code->save();
        return redirect()->route('code.getCreate', ['id' => $code->code_type]);
        //return redirect("codeType/addCode/".$request->input('codeType'));
    }

    public function editCode(Code $code)
    {
        $data['code'] = $code;
        $data['codeType'] = $code->type->name;
        $data['id'] = $code->id;
        $data['back'] = $code->type->id;
        $data['codeTypeID'] = $code->type->id;
        return view('code.addCode')->with($data);
    }

    public function updateCode(Request $request, Code $code)
    {
        $code->code = $request->code;
        $code->update($request->all());
        return redirect()->route('code.edit', ['id' => $code->id]);
        //return redirect("codeType/".$codeType->codeType);
    }
    public function deleteCode($id)
    {
        $code = Code::findOrFail($id);
        $codeType = $code->code_type;
        $code->delete();
        return redirect()->route('codeTypes.show', ['id' => $codeType]);
    }

    public function specialList(CodeType $codeType){
         return view('code.publicList')->with('codeType', $codeType);
    }

    public function specialListDetail(Code $code){
        $data['code']=$code;
        $data['manuals']=ManualsCodes::join('manuals', 'manuals_codes.manual', '=', 'manuals.id')
            ->select('manuals.*')
            ->where('manuals_codes.code', '=', $code->id)
            ->get();
        $data['goodMedicals'] = AllergiesAndDiseasesMedical::join('codes', 'allergies_and_diseases_medical.cure', '=', 'codes.id')
            ->select('codes.*')
            ->where('allergies_and_diseases_medical.allergy_or_disease', '=', $code->id)
            ->get();
        return view('code.publicDetail')->with($data);
    }
}
