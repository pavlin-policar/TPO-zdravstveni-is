<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;
use App\Providers\ScheduleServiceProvider;

class CalendarScheduleRequest extends Request
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

        //dd('in request');
        return [
            'days' => 'required',
            'hourStart' => 'required|date_format:"H:i"',
            'hourEnd' => 'required|date_format:"H:i"|after:"hourStart"',
            'dayStart' => 'required|date|inFuture:"hourStart"',
            'dayEnd' => 'required|date|dateGTE:"dayStart","hourStart"',
            'interval' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'days.required' => 'Izbrati morate vsaj en dan!',
            'required' => 'Polje ne sme ostati prazno!',
            'date_format' => 'Napačno podana ura!',
            'date' => 'Datum podan v napačnem formatu!',
            'dayStart.in_future' => 'Vnesli ste pretečen datum!',
            'dayEnd.date_g_t_e' => 'Končni datum ne sme biti pred začetnim!',
            'after' => 'Začetek delavnika mora biti pred njegovim zaključkom!',
        ];
    }
}
