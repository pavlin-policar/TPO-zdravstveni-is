<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
    public function index(Request $request)
    {
        $this->authorize('can-see-all-users', User::class);
        $users = User::with('type')->get();
//        $users = User::whereNotNull('first_name')->with('type')->get();
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
        // Lahko bi nastavili neko default vrednost, samo ne vem kako? Spodaj je nedelujoč poskus.
        //if ($userType == NULL || $userType == '') $userType = 'doctor';
        $permissionName = 'can-create-' . strtolower($userType);
        $this->authorize($permissionName, User::class);
        // get the corresponding person type
        $type = Code::whereKey(strtoupper($userType))->firstOrFail();
        return view('users.create')->with('type', $type);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ],
            [
                'required' => 'Polje ne sme ostati prazno!',
                'max' => 'Elektronski naslov je lahko dolg največ 255 znakov!',
                'min'  => 'Geslo mora biti dolgo vsaj 8 znakov!',
                'unique' => 'Elektronski naslov že obstaja v naši bazi!',
                'confirmed'  => 'Geslo se ne ujema s potrditvijo!',
                'email' => 'Elektronski naslov je napačne oblike!',
                'regex'  => 'Geslo mora vsebovati vsaj en numeričen znak!',
            ]);

        if ($validator->fails()) {
            return view('users.create')->with('type', Code::DOCTOR())->withErrors($validator);
            //return view('users.create')->with('type', 'doctor')->withErrors($validator)->withInput();
        }

        //var_dump($request->person_type);
        if ($request->person_type == 1) {
            $user = $this->users->createNurse([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        } else if ($request->person_type == 0) {
            $user = $this->users->createPersonalDoctor([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }

        $this->sendPersonalDoctorActivationEmail($user, $request->password);
        request()->session()->flash(
            'message',
            'Uspešno ste se registrirali. Zdaj morate še aktivirati svoj račun z aktivacijsko kodo,'
            . ' ki smo vam jo poslali na elektronski naslov.'
        );

        return redirect()->route('profile.show', $user->id);
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
