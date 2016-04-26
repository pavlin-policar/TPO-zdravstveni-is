<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\DoctorDates;
use App\Models\User;
use App\Http\Requests\DoctorDateRequest;

class PatientController extends Controller
{
    /**
     * Show a profile for a given user to the doctor.
     *
     * @param User $user
     * @return mixed
     */
    public function show(User $user)
    {
        $this->authorize('can-view-profile', $user);
        return view('patients.view')->with('patient', $user);
    }

    public function addDate(DoctorDateRequest $request)
    {
        $date = new DoctorDates();
        $date->note = $request['note'];
        $date->time = $request['date'] . " " . $request['time2'];
        $date->patient = $request['patient'];
        $date->doctor = $request['doctor'];

        $date->save();

        return redirect()->back()->with('CheckAdded', 'Prijavljeni ste na pregled');
    }
}
