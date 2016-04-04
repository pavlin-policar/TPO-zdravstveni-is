<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Mail;
use Validator;

//require_once 'Mail.php';

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

    protected function authenticated()
    {
        $user = User::find(\Auth::user()->id);
        $name = $user->firstName;
        $user->last_login = date("Y-m-d H:i:s");
        $user->save();
        //$name = '';
        session(['showUser' => \Auth::user()->id]);
        if ($name == null || $name == '') {
            return redirect('/profileUpdate');
        } //return redirect()->intended('/profileUpdate');
        else {
            return redirect($this->redirectPath());
        } //return redirect()->intended('/home');
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
            //'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        //$this->redirectTo = '/url-after-register';
        $confirmation_code = str_random(30);
        //return User::create([
        $user = User::create([
            //'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code,
        ]);

        //var_dump(Input::get('email'));

        //TODO set up an email and configure .env, then uncomment below code and it should hopefully work
        /*Mail::send('email.verify', ['confirmation_code' => $confirmation_code], function($message) {
            $message->to(Input::get('email'), 'User')->subject('Verify your email address');
            $message->from('hello@ZIS.com', 'ZIS admin');
        });

        Flash::message('Thanks for signing up! Please check your email.');*/

        return $user;
    }

    public function confirm($confirmation_code)
    {
        if (!$confirmation_code) {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user) {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        Flash::message('You have successfully verified your account.');

        return Redirect::route('login_path');
    }
}
