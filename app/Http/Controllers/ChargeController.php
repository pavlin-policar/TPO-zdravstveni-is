<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProfileRequest;
use App\Models\User;
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
        $this->authorize('can-be-caretaker', User::class);
        return view('charges.index')->with('charges', Auth::user()->charges);
    }

    /**
     * Show a form to create a new charge.
     *
     * @return mixed
     */
    public function create()
    {
        $this->authorize('can-be-caretaker', User::class);
        return view('charges.create')->with('user', new User);
    }

    /**
     * Create a profile for the new user, and associate them with their caretaker i.e. the current
     * user.
     *
     * @param CreateProfileRequest $request
     */
    public function store(CreateProfileRequest $request)
    {
        $this->authorize('can-be-caretaker', User::class);
        Auth::user()->charges()->create($request->all());
        return redirect()->route('charges.index');
    }

    /**
     * Show the charge profile data.
     *
     * @param User $user
     * @return mixed
     */
    public function show(User $user)
    {
        $this->authorize('can-view-profile', $user);
        return view('charges.show')->with('charge', $user);
    }

    /**
     * Update the charges personal information on the profile page.
     *
     * @param CreateProfileRequest $request
     * @param User $user
     * @return mixed
     */
    public function update(CreateProfileRequest $request, User $user)
    {
        $this->authorize('can-update-personal-info', $user);
        $user->update($request->all());
        return redirect()->route('charges.show', [$user->id]);
    }
}
