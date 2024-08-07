<?php

namespace App\Policies;

use App\User;
use App\Category;
use App\Rule;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function userCategory(User $user, Category $category)
    {
        return $user->id === $category->user_id;
    }
    
    public function userCategoryRule(User $user, Category $category, Rule $rule)
    {
        return $user->id === $category->user_id && $category->id === $rule->category->id;
    }
}
