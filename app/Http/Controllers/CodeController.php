<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodeType;
use App\Models\Code;
use App\Http\Requests;

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
        return view('code.codes')->with($data);
    }
}
