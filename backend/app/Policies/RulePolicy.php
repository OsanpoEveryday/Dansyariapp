<?php

namespace App\Policies;

use App\Rule;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RulePolicy
{
    use HandlesAuthorization;

    public function userCategory(User $user, Category $category)
    {
        
    }
}
