<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateDoctorProfileRequest;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateDoctorsRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
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
        $this->users->updateUser($user, $request);
        $user->update($request->all());
        return redirect()->back();
    }

    /**
     * Update the doctors personal information.
     *
     * @param User $user
     * @param CreateDoctorProfileRequest $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateDoctorPersonalInfo(User $user, CreateDoctorProfileRequest $request)
    {
        $this->authorize('canUpdatePersonalInfo', $user);
        $this->users->updateDoctor($user, $request->all());
        return redirect()->back();
    }

    /**
     * Display the page that gives you a notice that you haven't completed registration yet.
     *
     * @return mixed
     */
    public function showGotoCreateProfile()
    {
        if (Auth::user()->hasCreatedProfile()) {
            return redirect()->back();
        }
        return view('profile.goto-profile-create');
    }

    /**
     * Display the create profile page, only the first time the user logs in without the profile.
     *
     * @return mixed
     */
    public function showCreateProfile()
    {
        $user = Auth::user();
        if ($user->hasCreatedProfile()) {
            return redirect()->back();
        }
        if ($user->isDoctor()) {
            return view('profile.create-doctor')->with('user', $user);
        } else {
            return view('profile.create-patient')->with('user', $user);
        }
    }

    /**
     * Persist the users information to the database when completing profile creation for the first
     * time.
     *
     * @param CreateProfileRequest $request
     * @return mixed
     */
    public function createPatientProfile(CreateProfileRequest $request)
    {
        if (Auth::user()->hasCreatedProfile()) {
            return redirect()->back();
        }
        $this->users->updatePatient(Auth::user(), $request->all());
        return redirect()->route('dashboard.show');
    }

    /**
     * Persist the doctors information to the database when a doctor creates their profile for the
     * first time.
     *
     * @param CreateDoctorProfileRequest $request
     */
    public function createDoctorProfile(CreateDoctorProfileRequest $request)
    {
        if (Auth::user()->hasCreatedProfile()) {
            return redirect()->back();
        }
        $this->users->updateDoctor(Auth::user(), $request->all());
        return redirect()->route('dashboard.show');
    }

    /**
     * Change the users password if the old password was correct.
     *
     * @param ChangePasswordRequest $request
     * @return mixed
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $userdata = array(
            'email' => $user->email,
            'password' => $request['oldPassword']
        );

        // attempt to do the login
        if (Auth::attempt($userdata)) {
            $user->password = bcrypt($request['password']);
            $user->update();
            return redirect()->back()->with('cahangedPass', 'Geslo je spremenjeno');

        } else {
            // validation not successful, wrong password

            return redirect()->back()->with('cahangePassError', 'Geslo ni spremenjeno');

        }

    }

    /**
     * Update the users personal doctor and dentist.
     *
     * @param UpdateDoctorsRequest $request
     * @return mixed
     */
    public function updateDoctors(UpdateDoctorsRequest $request)
    {

    }
}