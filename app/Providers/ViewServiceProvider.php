<?php

namespace App\Providers;

use App\Models\Code;
use App\Models\CodeType;
use App\Models\Postcode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
}
