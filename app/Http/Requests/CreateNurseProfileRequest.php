<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\CodeType;

class CreateNurseProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'birth_date' => 'date|before:today',
            'gender' => 'in:' .
                CodeType::whereKey(CodeType::$codeTypes['GENDER'])->firstOrFail()
                    ->codes->lists('id')->implode(','),

            'email' => 'required|email',
            'phone_number' => 'required',

            'doctor_number' => 'required|',
            'institution_id' => 'required|exists:codes,id',
        ];
    }
}
