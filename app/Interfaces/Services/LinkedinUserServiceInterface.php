<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface LinkedinUserServiceInterface
{
    public function findLinkedinUserByUserId(int $userId);
}
