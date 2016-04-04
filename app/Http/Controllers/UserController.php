<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateProfileRequest;
use App\Models\User;
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

//    public function showProfile()
//    {
//        //$result = Array();
//        //$result['firstName']= "test";
//        $id = \Auth::user()->id;
//        $result['user'] = User::findOrFail($id);
//        //return var_dump($result);
//        return view('partials.profile', $result);
//    }

    public function editProfile(Request $request)
    {

        $id = \Auth::user()->id;
        //$user = User::findOrFail($id);
        $result['user'] = User::findOrFail($id);

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
     * Show the users profile / settings page.
     *
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showProfile(User $user)
    {
        // If no user id was supplied, assume the user would like to edit their own profile.
        if (!$user->existsInStorage()) {
            $user = Auth::user();
        }
        $this->authorize('canViewProfile', $user);
        return view('profile.view')->with('user', $user);
    }

    /**
     * Update the users personal information.
     *
     * @param User $user
     * @param CreateProfileRequest $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updatePersonalInfo(User $user, CreateProfileRequest $request)
    {
        $this->authorize('canUpdatePersonalInfo', $user);
        $user->update($request->all());
        return redirect()->back();
    }

    /**
     * Display the page that gives you a notice that you haven't completed registration yet.
     *
     * @return mixed
     */
    public function showGotoCreateProfile()
    {
        if (Auth::user()->hasCompletedRegistration()) {
            return redirect()->back();
        }
        return view('profile.goto-profile-create');
    }

    /**
     * Display the create profile page.
     *
     * @return mixed
     */
    public function showCreateProfile()
    {
        if (Auth::user()->hasCompletedRegistration()) {
            return redirect()->back();
        }
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
        if (Auth::user()->hasCompletedRegistration()) {
            return redirect()->back();
        }
        // TODO test that this works, integrity constraint failures due to db being empty.
        Auth::user()->update($request->all());
        return redirect()->route('home.index');
    }

    //Change password
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $userdata = array(
            'email'     => $user->email,
            'password'  => $request['oldPassword']
        );

        // attempt to do the login
        if (Auth::attempt($userdata)) {
            $user->password = bcrypt($request['password']);
            $user->update();
            return redirect()->back();

        } else {

            // validation not successful, wrong password
            return "errror";

        }
        /*if(bcrypt($request['oldPassword']) === $user->password){
            $user->password = bcrypt($request['password']);
            $user->update();
            return redirect()->back();
        }
        else{
            return "wrong password";
        }
        */
    }

}