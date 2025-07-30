<?php

namespace App\Repositories;

use App\Interfaces\Repositories\FacebookUserRepositoryInterface;
use App\Models\FacebookUser;
use App\Models\User;

class FacebookUserRepository implements FacebookUserRepositoryInterface
{
    public function findByUserId(User $user)
    {
        return FacebookUser::where('user_id', $user->id)->first();
    }
}
