<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ChargeController extends Controller
{
    /**
     * Get a listing of all your charges.
     *
     * @return mixed
     */
    public function index()
    {
        return view('charges.index')->with('charges', Auth::user()->charges);
    }
}
