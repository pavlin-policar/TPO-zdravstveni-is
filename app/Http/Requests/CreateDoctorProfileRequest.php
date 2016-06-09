<?php

namespace App\Http\Requests;

use App\Models\CodeType;

class CreateDoctorProfileRequest extends Request
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
        $emailUnique = $this->route('user') === null ? '' :
            '|unique:users,email,' . $this->route('user')->id;
        $doctorNumberUnique = '|unique:doctor,doctor_number' . (
            $this->route('user') === null ?
                '' :
                (',' . $this->route('user')->doctorProfile->id)
            );

        return [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'birth_date' => 'date|before:today',
            'gender' => 'in:' .
                CodeType::whereKey(CodeType::$codeTypes['GENDER'])->firstOrFail()
                    ->codes->lists('id')->implode(','),

            'email' => 'required|email' . $emailUnique,
            'phone_number' => 'required',

            'doctor_number' => 'required' . $doctorNumberUnique,
            'max_patients' => 'required|numeric',
            'institution_id' => 'required|exists:codes,id',
        ];
    }
}
