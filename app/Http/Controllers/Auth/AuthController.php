<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Carbon\Carbon;
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
    protected $redirectTo = '/';

    protected $maxLoginAttempts = 3;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'password' => 'required|min:6|confirmed',
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
        session(['showUser' => $user->id]);

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
        $user = new User([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->confirmation_code = str_random(30);
        $user->save();

        Mail::send('email.confirm', [
            'confirmationCode' => $user->confirmation_code
        ], function ($message) use ($user) {
            $message
                ->to($user->email, $user->fullName)
                ->from('info@zis.com', 'Zdravstveni informacijski sistem')
                ->subject('Zaključite registracijo');
        });
        request()->session()->flash(
            'message',
            'Uspešno ste se registrirali. Zdaj morate še aktivirati svoj račun z aktivacijsko kodo,'
            . ' ki smo vam jo poslali na elektronski naslov.'
        );

        return $user;
    }

    /**
     * Confirm the users email with their confirmation code.
     *
     * @param Request $request
     * @param $confirmationCode
     * @return mixed
     */
    public function confirm(Request $request, $confirmationCode)
    {
        $user = User::whereConfirmationCode($confirmationCode)->firstOrFail();
        $user->confirmEmail();
        $user->save();

        $request->session()->flash(
            'message',
            'Uspešno ste aktivirali svoj račun.'
        );

        return redirect('/login');
    }

    /**
     * Send an activation email to a given user with the activation code they can use to complete
     * the registration process.
     *
     * @param $user
     */
    protected function sendActivationEmail($user)
    {
    }
}
