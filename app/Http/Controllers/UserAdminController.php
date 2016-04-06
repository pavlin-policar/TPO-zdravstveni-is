<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    private $users;

    /**
     * UserAdminController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Show a listing of all the registered users in the system.
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('can-see-all-users', User::class);
        $users = User::with('type')->get();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show a form to create a new doctor.
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        // TODO figure out a way to handle this if the user type method is not defined
        $userType = $request->get('type', 'patient');
        $permissionName = 'can-create-' . strtolower($userType);
        $this->authorize($permissionName, User::class);
        // get the corresponding person type
        $type = Code::whereKey(strtoupper($userType))->firstOrFail();
        return view('users.create')->with('type', $type);
    }
}
