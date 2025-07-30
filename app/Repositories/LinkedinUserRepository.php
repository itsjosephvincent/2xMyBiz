<?php

namespace App\Repositories;

use App\Interfaces\Repositories\LinkedinUserRepositoryInterface;
use App\Models\LinkedInUser;
use App\Models\User;

class LinkedinUserRepository implements LinkedinUserRepositoryInterface
{
    public function findByUserId(User $user)
    {
        return LinkedInUser::where('user_id', $user->id)->first();
    }
}
