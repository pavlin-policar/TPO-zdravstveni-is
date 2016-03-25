<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function showProfile($id)
    {
        return var_dump(['user' => User::findOrFail($id)]);
    }
}
