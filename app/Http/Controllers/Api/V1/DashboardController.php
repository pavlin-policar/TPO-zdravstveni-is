<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Api\V1\UpdateDashboardLayoutRequest;
use App\Models\DashboardLayout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Default values for the dashboard settings
     *
     * @var array
     */
    public static $defaults = [
        'dashboard-personnel' => true,
        'dashboard-past-checkups' => true,
        'dashboard-future-checkups' => true,
        'dashboard-medicine' => true,
        'dashboard-measurements' => true,
        'dashboard-sickness' => true,
        'dashboard-diets' => true,

        'num_displayed' => 10,

        'dashboard-birthdate' => true,
        'dashboard-gender' => true,
        'dashboard-email' => true,
        'dashboard-telephone' => true,
        'dashboard-address' => true,
        'dashboard-zz' => true,
    ];

    /**
     * Get the dashboard layout data for the given user.
     *
     * @param User $user
     * @return array
     */
    public function getDashboardLayout(User $user)
    {
        $result = DashboardLayout::where('active_user_id', Auth::user()->id)
            ->where('user_dashboard_id', $user->id)
            ->get();
        // no result was found
        return $result->isEmpty() ?
            ['active_user_id' => Auth::user()->id, 'user_dashboard_id' => $user->id] :
            $result;
    }

    /**
     * Update the dashboard layout for the given user.
     *
     * @param User $user
     * @param UpdateDashboardLayoutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDashboardLayout(User $user, UpdateDashboardLayoutRequest $request)
    {
        $reset = array_map(function ($el) {
            return !is_bool($el);
        }, static::$defaults);
        $settings = $request->all() + $reset;
        unset($settings['_method']);
        unset($settings['_token']);
        Auth::user()->update([
            'dashboard_layout' => json_encode($settings, true)
        ]);
        return redirect()->back();
    }
}
