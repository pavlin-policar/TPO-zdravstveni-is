<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodeType;
use App\Models\Code;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CodeController extends Controller
{
    public function showCodeTypes(){
        $data=Array();
        $data['array']=CodeType::all();
        return view('code.codeTypes')->with($data);
    }
    public function showCodesForType($id){
        $data=Array();
        $data['codeType']=CodeType::findOrFail($id)->codeItemName;
        $data['array']=Code::where('codeType', '=', $id)->get();
        $data['id']=$id;
        return view('code.codes')->with($data);
    }

    public function addCodeType(){
        $data=Array();
        return view('code.addCodeType')->with($data);
    }

    public function createCodeType(Request $request){
        $codeType = new CodeType();
        $codeType->codeItemName=$request->input('codeItemName');
        $codeType->codeItemDescription=$request->input('codeItemDescription');
        $codeType->save();
        return redirect()->route('code.index');
    }

    public function addCode($id){
        $data=Array();
        $data['codeType']=CodeType::findOrFail($id)->codeItemName;
        $data['id']=$id;
        $data['back']=$id;
        $data['code']=null;
        return view('code.addCode')->with($data);
    }

    public function createCode(Request $request){
        $codeType = new Code;
        $codeType->codeName=$request->input('codeName');
        $codeType->codeDescription=$request->input('codeDescription');
        $codeType->minValue=$request->input('minValue');
        $codeType->maxValue=$request->input('maxValue');
        $codeType->codeType=$request->input('curentId');
        $codeType->save();
        return redirect()->route('code.getCreate', ['id' => $request->input('curentId')]);
        //return redirect("codeType/addCode/".$request->input('codeType'));
    }

    public function editCode($id){
        $data=Array();
        $data['code']=Code::findOrFail($id);
        $data['codeType']=CodeType::findOrFail($data['code']['codeType'])->codeItemName;
        $data['id']=$id;
        $data['back']=$data['code']['codeType'];
        return view('code.addCode')->with($data);
    }

    public function updateCode(Request $request){
        $codeType = Code::findOrFail($request->input('curentId'));
        $codeType->codeName=$request->input('codeName');
        $codeType->codeDescription=$request->input('codeDescription');
        $codeType->minValue=$request->input('minValue');
        $codeType->maxValue=$request->input('maxValue');
        $codeType->save();
        return redirect()->route('code.edit', ['id' => $request->input('curentId')]);
        //return redirect("codeType/".$codeType->codeType);
    }
}
