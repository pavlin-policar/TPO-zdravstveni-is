<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;

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
}
