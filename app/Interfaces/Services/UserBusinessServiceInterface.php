<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface UserBusinessServiceInterface
{
    public function findUserBusinessByUserId(int $userId);
}
