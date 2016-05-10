<?php

namespace App\Providers;

use Carbon\Carbon;
use Validator;
use Illuminate\Support\ServiceProvider;


class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('inFuture', function($attribute, $value, $parameters, $validator) {
            $today = Carbon::now('Europe/Amsterdam');
            $start = Carbon::parse($value);
            $hourStart = Carbon::parse(array_get($validator->getData(), $parameters[0]));
            $startDateTime = Carbon::parse($start->toDateString() . ' ' . $hourStart->toTimeString());

            // Start date must come after this moment right now:
            $result = $startDateTime->gt($today);
            //dd($result);
            return $result;
        });


        Validator::extend('dateGTE', function($attribute, $value, $parameters, $validator) {
            // Get the two days and convert them to Carbon format:
            //dd($parameters);
            $start = Carbon::parse(array_get($validator->getData(), $parameters[0]));
            $hourStart = Carbon::parse(array_get($validator->getData(), $parameters[1]));
            $end = Carbon::parse($value);

            $startDateTime = Carbon::parse($start->toDateString() . ' ' . $hourStart->toTimeString());
            $endDateTime = Carbon::parse($end->toDateString() . ' ' . $hourStart->toTimeString());

            // End date must be later than start date:
            $result = $end->gte($start);
            //dd($result);
            return $result;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
