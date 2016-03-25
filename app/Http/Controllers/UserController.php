<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class UserController extends Controller
{
    public function showUser($id)
    {
        return var_dump(['user' => User::findOrFail($id)]);
    }

    public function showProfile()
    {
        if (\Auth::check())
        {
            return "JA";
        }
        return "Ne";
    }

    public function showLogin(Request $request)
    {
        return view('login');
    }

    public function doLogin()
    {
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = Validator::make(Input::all(), $rules);// run the validation rules on the inputs from the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            if (\Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'deleted_at' => NULL])) {
                $row = User::find(\Auth::user()->id);
                \DB::table('users')->where('id', '=',$row->id )->update(array('last_login' => date("Y-m-d H:i:s")));
                \Session::put('uid', $row->id);
                \Session::put('eid', $row->email);
                echo 'SUCCESS! '.\Session::get('uid')." in ".\Auth::user()->id;
                //return Redirect::to('user/profile');
                //return Redirect::to('dashboard');

            } else {

                return Redirect::to('login'); // validation not successful, send back to form

            }
        }
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

}
