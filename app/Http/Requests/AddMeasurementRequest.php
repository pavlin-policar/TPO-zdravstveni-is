<?php

namespace App\Http\Requests;


class AddMeasurementRequest extends Request
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
            'type' => 'required',
            'patient' => 'required',
            'provider' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Polje ne sme biti prazno!'
        ];
    }
}
