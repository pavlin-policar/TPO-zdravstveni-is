<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function canViewProfile(User $user, User $victim)
    {
        return
            $user->isSameUserAs($victim) or
            $user->isCaretakerOf($victim) or
            $user->isDoctorOf($victim) or
            $user->isAdmin();
    }

    public function canUpdatePersonalInfo(User $user, User $victim)
    {
        return
            $user->isSameUserAs($victim) or
            $user->isCaretakerOf($victim) or
            $user->isAdmin();
    }

    public function canUpdateDoctors(User $user, User $victim)
    {
        return
            $user->isSameUserAs($victim) or
            $user->isCaretakerOf($victim) or
            $user->isAdmin();
    }

    public function canBeCaretaker(User $user)
    {
        return !$user->isAdmin();
    }

    public function canSeeAllUsers(User $user)
    {
        return $user->isAdmin();
    }

    public function canSeeUserInfo(User $user)
    {
        return $user->isAdmin();
    }

    public function canCreateDoctor(User $user)
    {
        return $user->isAdmin();
    }
}
