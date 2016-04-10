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
        $users = User::whereNotNull('first_name')->with('type')->get();
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

    public function store(Request $request)
    {
        $user = $this->users->createPersonalDoctor([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        //$user->confirmation_code = str_random(30);

        /*$this->sendPersonalDoctorActivationEmail($user, $request->password);
        request()->session()->flash(
            'message',
            'Uspešno ste se registrirali. Zdaj morate še aktivirati svoj račun z aktivacijsko kodo,'
            . ' ki smo vam jo poslali na elektronski naslov.'
        );*/

        request()->session()->flash(
            'message',
            'Uspešno ste se registrirali. Zdaj morate še aktivirati svoj račun z aktivacijsko kodo,'
            . ' ki smo vam jo poslali na elektronski naslov.'
        );

        return $user;
    }

    /**
     * Send an activation email to a given elevated user with the activation code they can use to complete
     * the registration process. Attach their temp password.
     *
     * @param $user
     */
    protected function sendPersonalDoctorActivationEmail($user, $password)
    {
        Mail::send('email.doctorConfirm', [
            'confirmationCode' => $user->confirmation_code,
            'password' => $password
        ], function ($message) use ($user) {
            $message
                ->to($user->email, '')
                ->from('info@zis.com', 'Zdravstveni informacijski sistem')
                ->subject('Zaključite registracijo');
        });
    }
}
