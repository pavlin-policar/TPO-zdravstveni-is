<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Display the page that gives you a notice that you haven't completed registration yet.
     *
     * @return mixed
     */
    public function showGotoCreateProfile()
    {
        return view('profile.goto-profile-create');
    }

    /**
     * Display the create profile page.
     *
     * @return mixed
     */
    public function showCreateProfile()
    {
        return view('profile.create')->with('user', Auth::user());
    }

    /**
     * Persist the users information to the database.
     *
     * @param CreateProfileRequest $request
     * @return mixed
     */
    public function createProfile(CreateProfileRequest $request)
    {
        Auth::user()->update($request->all());
        return redirect()->route('home.index');
    }
}