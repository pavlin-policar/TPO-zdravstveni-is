<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Code;
use App\Models\CodeType;
use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showCodesForType(CodeType $codeType, $extension = null)
    {
        $this->authorize('can-see-code-type-codes', $codeType);

        if ($extension !== null) {
            return $this->generateCodeTypeFile($codeType, $extension, 'codes');
        } else {
            return view('code.codes')->with('codeType', $codeType);
        }
    }

    /**
     * Generate the appropriate file for the given data and file type for code type data.
     *
     * @param CodeType $codeType
     * @param $extension
     * @param $viewName
     * @return mixed
     */
    protected function generateCodeTypeFile(CodeType $codeType, $extension, $viewName)
    {
        $extension = substr($extension, 1);
        switch ($extension) {
            case 'json':
                return $codeType;
            case 'pdf':
                $pdf = PDF::loadView('code.pdf.' . $viewName, ['codeType' => $codeType]);
                return $pdf->stream(md5(time()) . '.pdf');
            default:
                break;
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
}
