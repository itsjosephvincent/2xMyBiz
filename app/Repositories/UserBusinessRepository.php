<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserBusinessRepositoryInterface;
use App\Models\User;
use App\Models\UserBusiness;

class UserBusinessRepository implements UserBusinessRepositoryInterface
{
    public function findByUserId(User $user)
    {
        return UserBusiness::where('user_id', $user->id)->first();
    }
}
