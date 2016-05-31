<?php

namespace App\Http\Requests;


class CheckMeasurementRequest extends Request
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
            'provider' => 'required',
            'check' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Polje ne sme biti prazno!',
        ];
    }
}
