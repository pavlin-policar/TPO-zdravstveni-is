<?php

namespace App\Http\Requests;

use App\Models\CodeType;

class CreateChargeRequest extends Request
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
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:' .
                CodeType::whereKey(CodeType::$codeTypes['GENDER'])->firstOrFail()
                    ->codes->lists('id')->implode(','),

            'email' => 'email|unique:users,email,' . $this->route('user')->id,
            'phone_number' => '',
            'post' => 'required|exists:posts,id',
            'address' => 'required',

            'zz_card_number' => 'required|unique:users,zz_card_number,' . $this->route('user')->id,

            'relation_id' => 'in:' .
                CodeType::whereKey(CodeType::$codeTypes['PERSON_RELATIONSHIPS'])->firstOrFail()
                    ->codes->lists('id')->implode(','),
        ];
    }
}
