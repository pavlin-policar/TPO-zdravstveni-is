<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CodeTypePolicy
{
    use HandlesAuthorization;

    public function canSeeCodeTypeCodes(User $user)
    {
        return $user->isAdmin();
    }
}
