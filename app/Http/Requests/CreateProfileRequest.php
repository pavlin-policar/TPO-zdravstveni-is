<?php

namespace App\Http\Requests;

use App\Repositories\GenderRepository;

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
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'birth_date' => 'required|date|before:today',
            'gender' =>'required|in:' .
                app(GenderRepository::class)->getGenders()->lists('id')->implode(','),

            'email' => 'required|email',
            'phone_number' => 'required',
            'post' => 'required|exists:posts,id',
            'address' => 'required',

            'zz_card_number' => 'required',
        ];
    }
}
