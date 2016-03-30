<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function canViewProfile(User $user, User $victim)
    {
        // TODO add caretakers to the list of users that can view a user profile
        return
            $user->isSameUserAs($victim) or
            $user->isAdmin();
    }

    public function canUpdatePersonalInfo(User $user, User $victim)
    {
        // TODO add caretakers to the list of users that can update a user profile
        return
            $user->isSameUserAs($victim) or
            $user->isAdmin();
    }
}
