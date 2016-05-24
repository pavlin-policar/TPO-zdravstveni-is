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
            'type' => 'required|between:1,3',
            'provider' => 'required',
            'check' => 'required',
            'result' => 'required|min:-50|max:600'
        ];
    }

    public function messages()
    {
        return [
            'between' => 'Izbrati morate tip meritve!',
        ];
    }
}
