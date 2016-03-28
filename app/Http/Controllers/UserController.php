<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    //$data['id']

    public function showProfile()
    {
        //$result = Array();
        //$result['firstName']= "test";
        $id = \Auth::user()->id;
        $result['user']= User::findOrFail($id);
        //return var_dump($result);
        return view('partials.profile', $result);
    }

    public function editProfile(Request $request) {

        $id = \Auth::user()->id;
        //$user = User::findOrFail($id);
        $result['user']= User::findOrFail($id);

        //TODO input validation
        /*$this->validate($request, [
            $request->input('firstName') => 'required|max:255',
            $request->input('lastName') => 'required|max:255',
            $request->input('email')  => 'required',
            $request->input('address') => 'required|max:255',
            $request->input('phoneNumber') => 'required',
            $request->input('ZZCardNumber') => 'required|unique',
        ]);*/




        $result['user']->firstName = $request->input('firstName');
        $result['user']->lastName = $request->input('lastName');
        $result['user']->email = $request->input('email');
        $result['user']->address = $request->input('address');
        //$result['user']->post = $request->input('post');
        $result['user']->phoneNumber = $request->input('phoneNumber');
        $result['user']->ZZCardNumber = $request->input('ZZCardNumber');
        //$user->gender = $request->input('gender');

        $result['user']->save();

        return view('partials.profile', $result);
    }

}