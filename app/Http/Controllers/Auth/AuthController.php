<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidActivationCodeException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';


    protected $maxLoginAttempts = 3;
    
    private $users;

    /**
     * Create a new authentication controller instance.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;

        $this->middleware($this->guestMiddleware(), ['except' => [
            'logout',
            'showConfirmationPage',
            'confirm',
        ]]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[\d,.;:]).+$/',
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
    }

    /**
     * This method is called if the user has successfully logged in.
     *
     * @param $request
     * @param User $user The authenticated user object.
     */
    protected function authenticated($request, User $user)
    {
        $user->update([
            'last_login' => Carbon::now(),
        ]);
        session(['user' => $user->id]);
        session(['showUser' => $user->id]);
        session(['isMyProfile' => true]);
        //if (!$user->confirmed) session(['resendMail' => true]);

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = $this->users->createPatient([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->confirmation_code = str_random(30);
        $user->save();

        $this->sendActivationEmail($user);
        request()->session()->flash(
            'message',
            'Uspešno ste se registrirali. Zdaj morate še aktivirati svoj račun z aktivacijsko kodo,'
            . ' ki smo vam jo poslali na elektronski naslov.'
        );

        return $user;
    }

    /**
     * Show the page where users can manually enter the activation code to their email that they
     * received from us.
     *
     * @param Request $request
     * @return
     * @throws \App\Exceptions\InvalidActivationCodeException
     */
    public function showConfirmationPage(Request $request)
    {
        if ($request->has('activation-code')) {
            $this->confirmUserEmail($request->get('activation-code'));
            return redirect('/logout');
        } else {
            return view('auth.confirm-email');
        }
    }

    /**
     * Confirm the users email with their confirmation code.
     *
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\InvalidActivationCodeException
     */
    public function confirm(Request $request)
    {
        $this->confirmUserEmail($request->get('confirmationCode'));

        $request->session()->flash(
            'message',
            'Uspešno ste aktivirali svoj račun.'
        );

        return redirect('/login');
    }

    /**
     * Check if the given token exists, and if it does, confirm the email.
     *
     * @param $token
     * @throws InvalidActivationCodeException
     */
    protected function confirmUserEmail($token)
    {
        $user = User::whereConfirmationCode($token)->first();
        if ($user === null) {
            throw new InvalidActivationCodeException;
        }
        $user->confirmEmail();
        $user->save();
    }

    /**
     * Send an activation email to a given user with the activation code they can use to complete
     * the registration process.
     *
     * @param $user
     */
    protected function sendActivationEmail($user)
    {
        return Mail::send('email.confirm', [
            'confirmationCode' => $user->confirmation_code
        ], function ($message) use ($user) {
            $message
                ->to($user->email, '')
                ->from('info@zis.com', 'Zdravstveni informacijski sistem')
                ->subject('Zaključite registracijo');
        });
    }

    /**
     * View the form that lets you resend account activation code, necessary for
     * successful registration process.
     *
     *
     */
    protected function resendEmail()
    {
        return view('auth.resend-email');
    }

    /**
     * Resend an activation email to a given user with the activation code they can use to complete
     * the registration process.
     *
     *
     */
    protected function resendInputEmail(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        //return $user;
        if ($user != null) {
            if ($this->sendActivationEmail($user)) {
                $request->session()->flash('resend_success', 'Sporočilo poslano. Aktivirajte račun!');
                return redirect()->route('registration.confirm-email');
            }
            else {
                $request->session()->flash('resend_success', 'Prišlo je do napake! Poskusite znova');
                return view('auth.resend-email');
            }
        }
        else
        {
            $request->session()->flash('resend_success', 'Uporabnik s tem elektronskim sporočilom ne obstaja!');
            return view('auth.resend-email');
        }
    }



}
