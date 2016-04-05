<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateChargeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChargeController extends Controller
{
    /**
     * Get a listing of all your charges.
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
     * @param CreateChargeRequest $request
     * @return
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CreateChargeRequest $request)
    {
        $this->authorize('can-be-caretaker', User::class);
        $user = Auth::user()->charges()->create($request->all());
        $this->createRelation(Auth::user(), $user, $request->get('relation_id'));
        return redirect()->route('charges.index');
    }

    /**
     * Show the charge profile data.
     *
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('can-view-profile', $user);
        return view('charges.show')->with('charge', $user);
    }

    /**
     * Update the charges personal information on the profile page.
     *
     * @param CreateChargeRequest $request
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CreateChargeRequest $request, User $user)
    {
        $this->authorize('can-update-personal-info', $user);
        $user->update($request->all());
        $this->createRelation(Auth::user(), $user, $request->get('relation_id'));
        return redirect()->route('charges.show', [$user->id]);
    }

    /**
     * Add the relation between two users to the database.
     *
     * @param User $user1
     * @param User $user2
     * @param $relationId
     */
    protected function createRelation(User $user1, User $user2, $relationId)
    {
        // add relation to pivot table
        $user1->relationships()->sync([$user2->id => ['relation_id' => $relationId]]);
        // define the inverse
        $user2->relationships()->sync([$user1->id => ['relation_id' => $relationId]]);
    }
}
