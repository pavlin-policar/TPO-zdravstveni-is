<?php

namespace App\Http\Controllers;

use App\Models\Manual;
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
}
