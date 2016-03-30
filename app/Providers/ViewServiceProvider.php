<?php

namespace App\Providers;

use App\Models\CodeType;
use App\Repositories\GenderRepository;
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
                DB::table('posts')
                    ->selectRaw("id, CONCAT(post, ' (', postCode, ')') AS display")
                    ->orderBy('display', 'asc')
                    ->lists('display', 'id')
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
}
