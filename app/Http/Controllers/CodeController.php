<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Code;
use App\Models\CodeType;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function showCodeTypes()
    {
        return view('code.codeTypes')
            ->with('codeTypes', CodeType::all());
    }

    public function showCodesForType($id)
    {
        $data['codeType'] = CodeType::findOrFail($id)->codeItemName;
        $data['array'] = Code::where('code_type', $id)->get();
        $data['id'] = $id;
        return view('code.codes')->with($data);
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
        $data['id'] = $codeType->id;
        $data['back'] = $codeType->id;
        $data['code'] = null;
        return view('code.addCode')->with($data);
    }

    public function createCode(Request $request)
    {
        $code = Code::create($request->all());
        return redirect()->route('code.getCreate', ['id' => $code->code_type]);
        //return redirect("codeType/addCode/".$request->input('codeType'));
    }

    public function editCode(Code $code)
    {
        $data['code'] = $code;
        $data['codeType'] = $code->type->name;
        $data['id'] = $code->id;
        $data['back'] = $code->type->id;
        return view('code.addCode')->with($data);
    }

    public function updateCode(Request $request, Code $code)
    {
        $code->update($request->all());
        return redirect()->route('code.edit', ['id' => $code->id]);
        //return redirect("codeType/".$codeType->codeType);
    }
}
