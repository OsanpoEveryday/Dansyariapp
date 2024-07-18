<?php

namespace App\Policies;

use App\Rule;
use App\User;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RulePolicy
{
    use HandlesAuthorization;

    public function userRule(User $user, Rule $rule)
    {
        $category = Category::find($rule->category_id);
        return $user->id === $category->user_id;
    }
}
