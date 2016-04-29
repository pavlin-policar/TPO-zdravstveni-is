<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Manual;
use App\Models\ManualsCodes;
use Illuminate\Http\Request;

use App\Http\Requests;

class ManualController extends Controller
{
    public function showList()
    {
        return view('manuals.list')
            ->with('manuals', Manual::all());
    }
    public function addManual()
    {
        $data['manual']=null;
        return view('manuals.addManual')->with($data);
    }
    public function createManual(Request $request)
    {
        Manual::create($request->all());
        return redirect()->route('manuals.list');
    }
    public function editManual(Manual $manual)
    {
        $data['manual'] = $manual;
        $data['id'] = $manual->id;
        return view('manuals.addManual')->with($data);
    }
    public function updateManual(Request $request, Manual $manual)
    {
        $manual->update($request->all());
        return redirect()->route('manuals.edit', ['id' => $manual->id]);
        //return redirect("codeType/".$codeType->codeType);
    }

    public function editCodeManual(Code $code)
    {
        $data['code'] = $code;
        $data['goodMedicals'] = ManualsCodes::join('manuals', 'manuals_codes.manual', '=', 'manuals.id')
            ->select('manuals.*')
            ->where('manuals_codes.code', '=', $code->id)
            ->get();
        $notIn = Array();
        foreach($data['goodMedicals'] as $m){
            $notIn[]=$m->id;
        } //kompliciranje, ce znas bol, poprav
        $data['allMedicals'] = Manual::whereNotIn('id', $notIn)->get();
        //die(var_dump($disease));
        $data['back'] = "code.index";
        $data['save'] = "manuals.editManualsList";
        $data['postParameter'] = "manuals";
        return view('medicalDiseases.diseasesMedical')->with($data);
    }

    public function updateManualsList(Request $request)
    {
        //die($request);
        $id=$request['id'];
        $code=Code::findOrFail($id);
        $manuals=explode(",",$request['manuals']);
        if(empty($id))
            die("Empty");
        $old = ManualsCodes::join('manuals', 'manuals_codes.manual', '=', 'manuals.id')
            ->select('manuals_codes.*')
            ->where('manuals_codes.code', '=', $id)
            ->get();
        foreach($old as $new){
            if(in_array($new->manual,$manuals)){
                //echo $id." ostane";
                if(($key = array_search($new->manual, $manuals)) !== false) {
                    unset($manuals[$key]);
                }
            } else {
                //echo $new->id." izbris";
                //die();
                $new->delete();
            }
        }
        if(!empty($manuals))
            foreach ($manuals as $manual) {
                if(empty($manual))
                    continue;
                //echo $medical." dodaj";
                $new = new ManualsCodes();
                $new->code = $id;
                $new->manual = $manual;
                $new->save();
            }
        //var_dump($medicals);
        return redirect()->route('codeTypes.show', ['id' => $code->code_type]);
    }
}
