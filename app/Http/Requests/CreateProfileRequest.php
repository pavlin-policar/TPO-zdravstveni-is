<?php

namespace App\Http\Requests;

class CreateProfileRequest extends Request
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
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'birthDate' => 'required|date|before:today',
            'gender' => 'required',

            'email' => 'required|email',
            'phoneNumber' => 'required',
            'post' => 'required',
            'address' => 'required',

            'ZZCardNumber' => 'required',

            'personalDoctor' => 'required',
            'personalDentist' => 'required',
            'delegate' => '',
        ];
    }
}
