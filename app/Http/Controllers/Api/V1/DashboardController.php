<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\DashboardLayout;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
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
     */
    public function updateDashboardLayout(User $user, UpdateDashboardLayoutRequest $request)
    {

    }
}
