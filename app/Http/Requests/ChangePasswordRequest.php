<?php
/**
 * Created by PhpStorm.
 * User: Urban
 * Date: 03-Apr-16
 * Time: 12:50 PM
 */

namespace App\Http\Requests;

use App\Repositories\GenderRepository;

class ChangePasswordRequest extends Request
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
            'password' => 'required|min:8|confirmed|regex:/[0-9]/',
            'password_confirmation' => 'required|same:password',
            'oldPassword' => 'required'
        ];
    }
}
