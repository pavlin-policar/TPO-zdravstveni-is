<?php

namespace App\Http\Requests;


class CheckCodeRequest extends Request
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
            'note' => 'required',
            'start' => 'required',
            'check' => 'required',
            'code' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'max' => 'Vrednost ne sme biti večja od :max',
            'min' => 'Vrednost ne sme biti manjša od :min',
        ];
    }
}
