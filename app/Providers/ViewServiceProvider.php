<?php

namespace App\Providers;

use App\Models\Code;
use App\Models\CodeType;
use App\Models\DoctorProfile;
use App\Models\Postcode;
use GuzzleHttp\Message\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\NurseInstitutions;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composerPostsSelectBox();
        $this->composeInstitutionsSelectBox();
        $this->composeGenderRadioButtonsHz();
        $this->composeNavbar();
        $this->composeSidebar();
        $this->composeChargeForm();
        $this->composerDoctorsSelectBox();
        $this->composerDentistsSelectBox();
        $this->composerNursesSelectBox();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * The postcode select box should always receive a list of all options in format:
     * id => postDisplay (postcode)
     */
    protected function composerPostsSelectBox()
    {
        view()->composer('partials.form-elements.select-postal-codes', function ($view) {
            $view->with(
                'postcodes',
                Postcode::orderBy('post', 'asc')->get()->lists('display', 'id')->toArray()
            );
        });
    }

    protected function composeInstitutionsSelectBox()
    {
        view()->composer('partials.form-elements.select-institutions', function ($view) {
            $view->with(
                'institutions',
                CodeType::whereKey(CodeType::$codeTypes['INSTITUTIONS'])->first()->codes
                    ->lists('name', 'id')->toArray()
            );
        });
    }

    protected function composeGenderRadioButtonsHz()
    {
        view()->composer('partials.form-elements.radio-gender-buttons-hz', function ($view) {
            $view
                ->with('male', Code::MALE())
                ->with('female', Code::FEMALE());
        });
    }

    protected function composeNavbar()
    {
        view()->composer('partials.navbar', function ($view) {
            $view->with('user', Auth::user());
        });
    }

    protected function composeSidebar()
    {
        view()->composer('partials.sidebar', function ($view) {
            $view->with('user', Auth::user());
        });
    }

    protected function composeChargeForm()
    {
        view()->composer('charges.charge-form', function ($view) {
            $view->with(
                'relations',
                CodeType::whereKey(CodeType::$codeTypes['PERSON_RELATIONSHIPS'])->firstOrFail()
                    ->codes->lists('name', 'id')->toArray());
        });
    }

    protected function composerDoctorsSelectBox()
    {
        view()->composer(
            'partials.form-elements.select-personal-doctor',
            function ($view) {
                // get the doctor profiles with doctor type
                $profiles = DoctorProfile::where(
                    'doctor_type_id',
                    Code::whereKey(Code::$codeTypes['PERSONAL_DOCTOR'])->first()->id
                )->with('user')->get();
                $doctors = [];
                // get list of doctors in appropriate format
                $profiles->each(function ($profile) use (&$doctors) {
                    $user = $profile->user;
                    if (
                        $profile->isValid() and $user->acceptingPatients() or
                        $profile->isValid() and $user->isDoctorOf(Auth::user())
                    ) {
                        $doctors[$user->id] = '[' . $profile->institution->name . '] '
                            . $user->fullName;
                    }
                });
                $view->with('doctors', $doctors);
            }
        );
    }

    protected function composerDentistsSelectBox()
    {
        view()->composer(
            'partials.form-elements.select-personal-dentist',
            function ($view) {
                // get the doctor profiles with doctor type
                $profiles = DoctorProfile::where(
                    'doctor_type_id',
                    Code::whereKey(Code::$codeTypes['PERSONAL_DENTIST'])->first()->id
                )->with('user')->get();
                $doctors = [];
                // get list of doctors in appropriate format
                $profiles->each(function ($profile) use (&$doctors) {
                    $user = $profile->user;
                    if (
                        $profile->isValid() and $user->acceptingPatients() or
                        $profile->isValid() and $user->isDoctorOf(Auth::user())
                    ) {
                        $doctors[$user->id] = '[' . $profile->institution->name . '] '
                            . $user->fullName;
                    }
                });
                $view->with('dentists', $doctors);
            }
        );
    }

    protected function composerNursesSelectBox()
    {
        view()->composer(
            'partials.form-elements.select-nurse',
            function ($view) {

                // Get correct profile ID from url:
                preg_match("/[^\/]+$/", \Request::url(), $matches);
                $last_word = $matches[0];

                // Get correct user:
                $correctUser = Auth::user();
                if ($last_word != Auth::user()->id) $correctUser = User::where('id', '=', $last_word)->first();


                // Get the nurses from the same institution as this doctor:
                $docInstID = $correctUser->doctorProfile->institution_id;



                // Existing relations:
                $existing = User::join('doctor_nurse', 'users.id', '=', 'doctor_nurse.nurse')
                    ->where('doctor_nurse.doctor', '=', $correctUser->id)
                    ->get();

                $notIn = Array();
                foreach($existing as $m){
                    $notIn[]=$m->nurse;
                }

                // All new possible relations, without the existing ones:
                $profiles = User::where('person_type', '=', 5)
                                ->whereNotIn('id', $notIn)
                                ->get();

                $nurses = [];
                foreach($profiles as $profile) {
                    if ($profile->doctorProfile->institution_id == $docInstID) {
                        $nurses[$profile->id] = $profile->fullName;
                    }
                }

                /* DEPRECATED
                $existing = User::join('doctor_nurse', 'users.id', '=', 'doctor_nurse.nurse')
                    ->where('doctor_nurse.doctor', '=', Auth::user()->id)
                    ->get();

                $notIn = Array();
                foreach($existing as $m){
                    $notIn[]=$m->nurse;
                }

                $profiles = User::join('nurses_institutions', 'users.id', '=', 'nurses_institutions.nurse_id')
                    ->where('nurses_institutions.institution_id', '=', $docInstID)
                    ->whereNotIn('users.id', $notIn)
                    ->get();

                $nurses = [];
                foreach($profiles as $profile) {
                    $nurses[$profile->nurse_id] = $profile->fullName;
                }*/

                $view->with('nurses', $nurses);
            }
        );
    }
}
