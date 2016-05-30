<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Request;

class UpdateDashboardLayoutRequest extends Request
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
            'num_displayed' => 'integer|min:0',
        ];
    }
}
