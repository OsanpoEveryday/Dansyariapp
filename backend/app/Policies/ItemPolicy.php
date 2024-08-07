<?php

namespace App\Policies;

use App\Item;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;
    
    public function userItem(User $user, Item $item)
    {
        return $user->id === $item->user_id;
    }

}
