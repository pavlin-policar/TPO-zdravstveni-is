<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateDoctorProfileRequest;
use App\Http\Requests\CreateNurseProfileRequest;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateDoctorsRequest;
use App\Http\Requests\ElevateNurseRequest;
use App\Models\Code;
use App\Models\DoctorDates;
use App\Models\DoctorNurse;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
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
            if(session('isMyProfile'))
                $user = Auth::user();
            else
                $user = User::findOrFail(session('showUser'));
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
        $this->users->updateUser($user, $request->all());
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
     * Update the doctors personal information.
     *
     * @param User $user
     * @param CreateNurseProfileRequest $request
     * @return mixed
     */
    public function updateNursePersonalInfo(User $user, CreateNurseProfileRequest $request)
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
        } else if ($user->isNurse()) {
            return view('profile.create-nurse')->with('user', $user);
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
     * Persist the nurses information to the database when a nurse creates their profile for the
     * first time.
     *
     * @param CreateDoctorProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createNurseProfile(CreateNurseProfileRequest $request)
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
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateDoctors(UpdateDoctorsRequest $request, User $user)
    {
        $this->authorize('canUpdatePersonalInfo', $user);
        $this->users->updateUser($user, $request->all());
        return redirect()->back();
    }

    /**
     * Elevate chosen nurse's position.
     *
     * @param ElevateNurseRequest $request
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function elevateNurse(ElevateNurseRequest $request, User $user)
    {
        $this->authorize('canUpdateDoctors', $user);
        $this->users->elevateNurse($user, $request->nurse_id);
        return redirect()->back();
    }

    /**
     * Free doctor's elevated nurse.
     *
     * @param Request $request
     * @param User $nurse
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function freeNurse(Request $request, $nurse)
    {
        DoctorNurse::where('nurse', '=', $nurse)
                   ->where('doctor', '=', Auth::user()->id)->first()->delete();
        return redirect()->back();
    }
    
    /**
     * Delete a users account.
     *
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function deleteAccount(Request $request, User $user)
    {
        $this->authorize('canDeleteUser', $user);
        if (!password_verify($request->get('rm-password'), $user->password)) {
            return redirect()->back()
                ->withErrors(['rm-password' => 'Geslo se ne ujema z vašim obstoječim geslom.']);
        }
        $user->delete();
        Auth::logout();
        return redirect()->route('profile.deleted');
    }

    /**
     * Display the account successfully deleted page when deletion is successful.
     *
     * @return mixed
     */
    public function accountDeletedPage()
    {
        return view('profile.account-deleted');
    }
}