<?php

namespace App\Providers;

use App\Models\Postcode;
use App\Repositories\GenderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $this->composeGenderRadioButtonsHz();
        $this->composeNavbar();
        $this->composeSidebar();
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

    protected function composeGenderRadioButtonsHz()
    {
        view()->composer('partials.form-elements.radio-gender-buttons-hz', function ($view) {
            $view
                ->with('male', app(GenderRepository::class)->getMale())
                ->with('female', app(GenderRepository::class)->getFemale());
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
}
