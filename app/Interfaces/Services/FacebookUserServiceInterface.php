<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface FacebookUserServiceInterface
{
    public function findFacebookByUserId(int $userId);
}
